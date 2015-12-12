<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Authenticate extends Model
{
    // applied singleton pattern
    private static $instance = NULL;

    // define ENUM vars
    const SUPERUSER = "SUPERUSER";
    const PLAYER = 'PLAYER';

    // global variable authentication
    private $type;
    private $email;
    private $password;

    /**
     * default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Authenticate();
        }
        return self::$instance;
    }

    /**
     * @param $type {PLAYER|SUPERUSER}
     */
    public function set_type($type)
    {
        $this->type = $type;
    }

    /**
     * @param $email of administrator
     */
    public function set_email($email)
    {
        $this->email = $email;
    }

    /**
     * @param $password if administrator
     */
    public function set_password($password)
    {
        $this->password = $password;
    }


    /**
     * @return mixed type getter {PLAYER|SUPERUSER}
     */
    public function get_type()
    {
        return $this->type;
    }

    /**
     * @return mixed email getter
     */
    public function get_email()
    {
        return $this->email;
    }

    /**
     * @return mixed password getter
     */
    public function get_password()
    {
        return $this->password;
    }

    /**
     * invoked by: all possibilities need to check session existence for action on controller
     * @return bool true if super user has login, false if login not yet
     */
    public static function is_authorized()
    {
        // start session and check if superuser state exist in session
        if (session_status() == 1) {
            session_start();
        }

        if (isset($_SESSION['web_username']) && $_SESSION['web_state'] == User::ACTIVE) {
            return true;
        }
        return false;
    }

    /**
     * invoked by: all possibilities need to check session existence for action on controller
     * @return bool true if player has login, false if login not yet
     */
    public static function is_player()
    {
        // start session and check if player state exist in session
        if (session_status() == 1) {
            session_start();
        }

        if (isset($_SESSION['ply_username']) && $_SESSION['ply_state'] == player::ACTIVE) {
            return true;
        }
        return false;
    }

    /**
     * invoked by: all action that need confirm the credential in REST API
     * @param $token player secret key
     * @return bool bool true if player has login, false if login not yet
     */
    public static function is_valid_token($token)
    {
        if (session_status() == 1) {
            session_start();
        }

        if (isset($_SESSION['ply_key'])) {
            if ($_SESSION['ply_key'] == $token) {
                return true;
            }
        }
        return false;
    }

    /**
     * this function handle super admin login and player login
     * invoked by: Model.Authenticate.authenticate
     * @return boolean contain user exist status
     */
    private function check_player_user()
    {
        if ($this->get_type() == Authenticate::PLAYER) {
            $state = [
                Player::COLUMN_PLY_EMAIL => Authenticate::get_email(),
                Player::COLUMN_PLY_PASSWORD => md5(Authenticate::get_password())
            ];
            $query = $this->ReadWhere(Utility::TABLE_PLAYER, $state);
        }
        else if ($this->get_type() == Authenticate::SUPERUSER) {
            $state = [
                User::COLUMN_USR_USERNAME => Authenticate::get_email(),
                User::COLUMN_USR_PASSWORD => md5(Authenticate::get_password())
            ];
            $query = $this->ReadWhere(Utility::TABLE_USER, $state);
        } else {
            $query = false;
        }
        return $query;
    }


    /**
     * this function handle super admin login and player login
     * invoked by: Controller.Player.login()
     *             Controller.Administrator.login()
     * @return array contain login proceed and status
     */
    public function authenticate()
    {
        // create result variable will contain status grant or denied and user STATE
        $result_data = array();

        /*
         * invoke check_player_user() to run query by type of login.
         * if query success then check number of selected row, make sure it will return 1 row.
         * consider type of login then set the session
         */
        if ($this->check_player_user()) {
            // check result set return number of row is 1
            if ($this->CountRow() == 1) {
                $data = $this->FetchDataRow();

                if ($this->get_type() == "SUPERUSER") {
                    // create variable administrator login in session
                    $_SESSION['web_id']         = $data['usr_id'];
                    $_SESSION['web_username']   = $data['usr_username'];
                    $_SESSION['web_name']       = $data['usr_name'];
                    $_SESSION['web_avatar']     = $data['usr_avatar'];
                    $_SESSION['web_state']      = $data['usr_state'];

                    $result_data["state"] = $data['usr_state'];
                } else if ($this->get_type() == "PLAYER") {
                    // create variable player login in session
                    $_SESSION['ply_id']         = $data['ply_id'];
                    $_SESSION['ply_key']        = $data['ply_key'];
                    $_SESSION['ply_username']   = $data['ply_email'];
                    $_SESSION['ply_name']       = $data['ply_name'];
                    $_SESSION['ply_avatar']     = $data['ply_avatar'];
                    $_SESSION['ply_state']      = $data['ply_state'];

                    $result_data["state"] = $data['ply_state'];
                }

                // write result login granted and user state, contain SUPERUSER or {ACTIVE,PENDING,SUSPEND}
                $result_data["granted"] = true;

                // create authentication log
                $log = Log::getInstance();
                $log->logging_web_auth();

            } // if result return zero or more than 1 row
            else {
                $result_data["granted"] = false;
                $result_data["state"] = "<strong>Failed : </strong> username or password wrong";
            }
        } // query failed
        else {
            $result_data["granted"] = false;
            $result_data["state"] = "SQL Data Retrieve Error";
        }

        return $result_data;
    }

    /**
     * invoked by: Controller.Player.logout()
     *             Controller.Administrator.logout()
     * @param $user
     * @return bool
     */
    public function logout($user)
    {
        session_start();

        /*
         * check what type of user that will logout.
         * unset all active session
         */
        if ($user == "SUPERUSER") {
            // check if bc_username exist in session
            if (isset($_SESSION["web_username"]) && !empty($_SESSION["web_username"])) {
                // destroy session
                unset($_SESSION['web_id']);
                unset($_SESSION['web_username']);
                unset($_SESSION['web_name']);
                unset($_SESSION['web_avatar']);
                unset($_SESSION['web_state']);
                unset($_SESSION['web_total_player']);
                unset($_SESSION['web_new_player']);

                return true;
            } else {
                return false;
            }
        } else {
            // check if ply_username exist in session
            if (isset($_SESSION["ply_username"]) && !empty($_SESSION["ply_username"])) {
                // create destroy log
                $log = Log::getInstance();
                $log->logging_web_destroy();

                // destroy session
                unset($_SESSION['ply_id']);
                unset($_SESSION['ply_username']);
                unset($_SESSION['ply_name']);
                unset($_SESSION['ply_avatar']);
                unset($_SESSION['ply_state']);
            } else {
                return false;
            }
        }
        return false;
    }
}