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

    public function get_account()
    {
        $result = $this->Read(Utility::TABLE_ACCOUNT);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return null;
        }
    }

    public function post_transaction($description, $debit, $credit, $value, $day)
    {
        $key = uniqid();
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
            return null;
        }
    }

    public function get_general_ledger($day = null)
    {
        if($day != null){
            $journal = $this->get_general_journal($day);
        }
        else{
            $journal = $this->get_general_journal();
        }

        $accounts = $this->get_account();

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

    public function get_trial()
    {
        $ledger = $this->get_general_ledger();
        $trial = array();

        foreach ($ledger as $table) {
            $total_debit = 0;
            $total_credit = 0;
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

    public function get_loss_profit()
    {
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
        array_unshift($expense, $advertising);
        array_unshift($expense, $marketing);

        array_push($data, $revenue, $expense);

        return $data;
    }

    public function get_balance_sheet()
    {
        $trial = $this->get_trial();

        $current_assets = array();
        $fixed_assets = array();
        $liabilities = array();
        $equity = array();


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

}