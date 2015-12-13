<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class AccountingController extends Controller
{
    private $model_journal;

    /**
     * prevent access this route via browser
     */
    public function index()
    {
        transport("error404");
    }

    /**
     * post transaction from game into journal.
     * this method will invoked async via post request as REST
     * role: player
     */
    public function post_transaction()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

                /*
                 * populate data from post request via REST.
                 * pass the data to model method to save it into database.
                 * return json status query.
                 */
                $description = $_POST['description'];
                $debit = $_POST['debit'];
                $credit = $_POST['credit'];
                $value = $_POST['value'];
                $day = $_POST['day'];

                $result = $this->model_journal->post_transaction($description, $debit, $credit, $value, $day);

                $binding = array(
                    "result_var" => "session_ready",
                    "posting_var" => $result
                );
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * retrieve journal report as json data
     * role: player
     */
    public function retrieve_journal()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

                /*
                 * if day variable is sets, then retrieve transaction for that day.
                 * convert array into json format.
                 */
                if(!isset($_POST["day"]) || empty($_POST["day"])){
                    $day = null;
                }
                else{
                    $day = $_POST["day"];
                }
                $result = $this->model_journal->get_general_journal($day);

                $binding = array(
                    "result_var" => "session_ready",
                    "journal_var" => json_encode($result, JSON_PRETTY_PRINT)
                );
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * retrieve general ledger as json data
     * role: player
     */
    public function retrieve_ledger()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

                /*
                 * populate day of ledger.
                 * invoke method which returned general ledger data.
                 * binding data as json format.
                 */
                $day = $_POST["day"];

                $result = $this->model_journal->get_general_ledger($day);

                $binding = array(
                    "result_var" => "session_ready",
                    "ledger_var" => json_encode($result, JSON_PRETTY_PRINT)
                );
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * retrieve trial balance as json data
     * role: player
     */
    public function retrieve_trial_balance()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

                /*
                 * invoke method to retrieve trial balance report.
                 * convert into json and binding these data.
                 */
                $result = $this->model_journal->get_trial();

                $binding = array(
                    "result_var" => "session_ready",
                    "trial_var" => json_encode($result, JSON_PRETTY_PRINT)
                );
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * retrieve loss and profit as json data
     * role: player
     */
    public function retrieve_loss_profit()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

                /*
                 * invoke method to retrieve loss and profit data.
                 * convert into json and binding these data.
                 */
                $result = $this->model_journal->get_loss_profit();

                $binding = array(
                    "result_var" => "session_ready",
                    "loss_profit_var" => json_encode($result, JSON_PRETTY_PRINT)
                );
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * retrieve balance sheet from database.
     * role: player
     */
    public function retrieve_balance()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

                /*
                 * invoke method to retrieve balance data.
                 * convert into json format and binding these data.
                 */
                $result = $this->model_journal->get_balance_sheet();

                $binding = array(
                    "result_var" => "session_ready",
                    "balance_var" => json_encode($result, JSON_PRETTY_PRINT)
                );
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }
}