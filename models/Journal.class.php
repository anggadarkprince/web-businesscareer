<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Journal extends Model
{
    // applied singleton pattern
    private static $instance = NULL;

    /**
     * default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null|object|Journal
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Journal();
        }
        return self::$instance;
    }

    /**
     * invoked by: Controller.GameServer.load_data()
     * @return array
     */
    public function get_account()
    {
        $result = $this->Read(Utility::TABLE_ACCOUNT);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

    /**
     * save transaction into database.
     * invoked by: Controller.Journal.post_transaction()
     * @param $description
     * @param $debit
     * @param $credit
     * @param $value
     * @param $day
     * @return bool
     */
    public function post_transaction($description, $debit, $credit, $value, $day)
    {
        // generate unique id as key for transaction as one
        $key = uniqid();

        // insert debit row
        $data = array(
            "jrl_player" => $_SESSION['ply_id'],
            "jrl_account" => $debit,
            "jrl_key" => $key,
            "jrl_description" => $description,
            "jrl_debit" => $value,
            "jrl_credit" => 0,
            "jrl_day" => $day
        );
        $this->Create(Utility::TABLE_JOURNAL, $data);

        // insert credit row
        $data = array(
            "jrl_player" => $_SESSION['ply_id'],
            "jrl_account" => $credit,
            "jrl_key" => $key,
            "jrl_description" => $description,
            "jrl_debit" => 0,
            "jrl_credit" => $value,
            "jrl_day" => $day
        );
        $this->Create(Utility::TABLE_JOURNAL, $data);

        return true;
    }

    /**
     * retrieve journal from database.
     * invoked by: Controller.Accounting.get_general_journal()
     *             Model.Journal.get_general_ledger()
     * @param null $day
     * @return array
     */
    public function get_general_journal($day = null)
    {
        $player = $_SESSION['ply_id'];

        $query = "
            SELECT
                acn_id AS account_id,
                acn_account AS account,
                DATE_FORMAT(jrl_created_at, '%d/%m/%Y') AS date,
                jrl_day AS day,
                jrl_key AS journal_key,
                IFNULL(jrl_description,'-') AS description,
                CASE WHEN jrl_debit=0 OR jrl_debit IS NULL THEN '-' ELSE jrl_debit END AS debit,
                CASE WHEN jrl_credit=0  OR jrl_credit IS NULL THEN '-' ELSE jrl_credit END AS credit,
                acn_position AS position
            FROM bc_account

            INNER JOIN bc_journal
              ON acn_id = jrl_account

            WHERE jrl_player = $player
        ";

        if($day != null){
            $query .= " AND jrl_day = $day";
        }

        $result = $this->ManualQuery($query);

        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

    /**
     * retrieve general ledger from database.
     * invoked by: Controller.Accounting.get_general_ledger()
     *             Model.Journal.get_trial()
     * @param null $day
     * @return array
     */
    public function get_general_ledger($day = null)
    {
        /*
         * retrieve general journal before convert into general ledger.
         * retrieve account to compare data.
         */
        if($day != null){
            $journal = $this->get_general_journal($day);
        }
        else{
            $journal = $this->get_general_journal();
        }

        $accounts = $this->get_account();

        /*
         * group transaction into each account.
         * check if there is account empty just give one row as info.
         */
        $ledger = array();
        foreach ($accounts as $account) {
            $table_account = array();

            foreach ($journal as $transaction) {
                if ($transaction['account_id'] == $account['acn_id']) {
                    array_push($table_account, $transaction);
                }
            }

            if (sizeof($table_account) == 0) {
                $ex = array(
                    "account_id" => $account["acn_id"],
                    "0" => $account["acn_id"],
                    "account" => $account["acn_account"],
                    "1" => $account["acn_account"],
                    "date" => "-",
                    "2" => "-",
                    "day" => $day,
                    "3" => $day,
                    "journal_key" => "-",
                    "4" => "-",
                    "description" => "Tidak Ada Transaksi",
                    "5" => "Tidak Ada Transaksi",
                    "debit" => "-",
                    "6" => "-",
                    "credit" => "-",
                    "7" => "-",
                    "position" => $account["acn_position"],
                    "8" => $account["acn_position"],
                );
                array_push($table_account, $ex);
            }

            array_push($ledger, $table_account);
        }

        return $ledger;
    }

    /**
     * retrieve trial balance report from database.
     * invoked by: Controller.Accounting.retrieve_trial_balance()
     *             Model.Journal.get_loss_profit()
     *             Model.Journal.get_balance_sheet()
     * @return array
     */
    public function get_trial()
    {
        /*
         * retrieve general ledger to convert into trial balance.
         * loop through ledger data and accumulate debit and credit as normal position.
         */
        $ledger = $this->get_general_ledger();
        $trial = array();

        foreach ($ledger as $table) {
            $total_debit = 0;
            $total_credit = 0;

            /*
             * loop through general table, accumulate each account table.
             * if normal position is debit then debit transaction will increase the balance.
             *                                  credit transaction will decrease the balance.
             * if normal position is credit then credit transaction will increase the balance.
             *                                  debit transaction will decrease the balance.
             */
            foreach ($table as $row) {
                if ($row["position"] == "DEBITS") {
                    if ($row["debit"] == "-") {
                        $total_debit -= $row["credit"];
                    } else {
                        $total_debit += $row["debit"];
                    }
                } else if ($row["position"] == "CREDITS") {
                    if ($row["debit"] == "-") {
                        $total_credit += $row["credit"];
                    } else {
                        $total_credit -= $row["debit"];
                    }
                }
            }

            // populate data into array and push as trial balance array as balance account
            $account = array(
                "account_id" => $table[0]["account_id"],
                "account" => $table[0]["account"],
                "debit" => $total_debit,
                "credit" => $total_credit,
                "position" => $table[0]["position"],
            );

            array_push($trial, $account);
        }

        return $trial;
    }

    /**
     * retrieve loss and profit from database.
     * invoked by: Controller.Journal.retrieve_loss_profit()
     * @return array
     */
    public function get_loss_profit()
    {
        /*
         * retrieve trial balance to get normal position of account.
         * prepare array that handle loss and profit data.
         * prepare expenses and revenues data, show advertising and marketing as separated detail
         */
        $trial = $this->get_trial();

        $data = array();

        $expense = array();
        $revenue = array();

        $advertising = array();
        $marketing = array();

        foreach ($trial as $row) {
            if ($row["position"] == "DEBITS") {
                $temp = array("account" => $row["account"], "value" => $row["debit"]);
            } else {
                $temp = array("account" => $row["account"], "value" => $row["credit"]);
            }

            /*
             * retrieve account type from pattern.
             * eg: $row['account'] -> [Revenue] then break into parts '['->(0), 'Revenue'->(1), ']'->(3)
             * if type of account is Revenue then pass through it.
             * if type of account is Expense, specially for Advertising and marketing show the detail.
             */
            preg_match("/\[([^]]*)\]/", $row["account"], $account);
            preg_match("/\]([^]]*)\:/", $row["account"], $sub_expense);
            $account_type = $account[1];

            if ($account_type == "Revenue") {
                $revenue[] = $temp;
            }
            if ($account_type == "Expense") {
                if (sizeof($sub_expense) > 0 && trim($sub_expense[1]) == "Advertising") {
                    $advertising[] = $temp;
                } else if (sizeof($sub_expense) > 0 && trim($sub_expense[1]) == "Marketing") {
                    $marketing[] = $temp;
                } else {
                    $expense[] = $temp;
                }
            }
        }

        /*
         * add advertising and marketing data front of array,
         * push revenue and all expenses into loss and profit array.
         */
        array_unshift($expense, $advertising);
        array_unshift($expense, $marketing);

        array_push($data, $revenue, $expense);

        return $data;
    }

    /**
     * retrieve balance from database.
     * invoked by: Controller.Accounting.retrieve_balance()
     * @return array
     */
    public function get_balance_sheet()
    {
        /*
         * retrieve trial balance.
         * prepare component of balance sheet as arrays.
         */
        $trial = $this->get_trial();

        $current_assets = array();
        $fixed_assets = array();
        $liabilities = array();
        $equity = array();

        /*
         * loop through trial balance data and distribute each component.
         * separate between activa, pasiva and modal
         */
        foreach ($trial as $row) {
            if ($row["position"] == "DEBITS") {
                $temp = array("account" => $row["account"], "value" => $row["debit"]);
            } else {
                $temp = array("account" => $row["account"], "value" => $row["credit"]);
            }

            if ($row["account"] == "[Assets] Inventory" || $row["account"] == "[Assets] Cash") {
                $current_assets[] = $temp;
            }
            if ($row["account"] == "[Assets] Cart, Sign, Equipment") {
                $fixed_assets[] = $temp;
            }
            if ($row["account"] == "[Liabilities and Equity] Loans") {
                $liabilities[] = $temp;
            }
            if ($row["account"] == "[Liabilities and Equity] Equity : Paid-in Capital") {
                $equity[] = $temp;
            }
        }

        return array($current_assets, $fixed_assets, $liabilities, $equity);
    }

    public function finance_summaries($id)
    {
        if(isset($_SESSION['ply_id'])){
            $temp = $_SESSION['ply_id'];
            $data = $this->retrieve_finance_status();
            $_SESSION['ply_id'] = $temp;
        }
        else{
            $_SESSION['ply_id'] = $id;
            $data = $this->retrieve_finance_status();
            unset($_SESSION['ply_id']);
        }
        return $data;
    }

    private function retrieve_finance_status()
    {
        $balance =  $this->get_balance_sheet();

        $asset = 0;
        for($i = 0; $i < 2; $i++){
            for($j = 0; $j < count($balance[$i]); $j++){
                $asset = $asset + $balance[$i][$j]["value"];
            }
        }

        $equity = $balance[3][0]["value"];
        $payable = $balance[2][0]["value"];

        $loss_profit = $this->get_loss_profit();

        $revenue = $loss_profit[0][0]["value"] + $loss_profit[0][1]["value"];

        $expense = 0;
        for($i = 0; $i < count($loss_profit[1]); $i++){
            if($i < 2){
                for($j = 0; $j < count($loss_profit[1][$i]); $j++){
                    $expense = $expense + $loss_profit[1][$i][$j]["value"];
                }
            }
            else{
                $expense = $expense + $loss_profit[1][$i]["value"];
            }
        }

        return [
            "assets"    => $asset,
            "equity"    => $equity,
            "revenue"   => $revenue,
            "payable"   => $payable,
            "expense"   => $expense
        ];
    }

}