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

    public function index()
    {
        transport("error404");
    }

    public function post_transaction()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

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

    public function retrieve_journal()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

                if(!isset($_POST["day"]) || empty($_POST["day"])){
                    $day = null;
                }
                else{
                    $day = $_POST["day"];
                }
                $result = $this->model_journal->get_general_journal($day);
                Utility::pretty_print(json_encode($result, JSON_PRETTY_PRINT));
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

    public function retrieve_ledger()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

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

    public function retrieve_trial_balance()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

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

    public function retrieve_loss_profit()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

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

    public function retrieve_balance()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_journal = Journal::getInstance();

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