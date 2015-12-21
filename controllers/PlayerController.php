<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class PlayerController extends Controller
{
    /**
     * show player list on table and summarized from sidebar navigation.
     * role: administrator
     * redirected from: Controller.Player.delete() whatever player delete result
     */
    public function index()
    {
        if (Authenticate::is_authorized()) {
            $model_player = Player::getInstance();
            $model_player->get_total_player();
            $model_player->read_new_player();
            $model_player->unread_new_player();

            $this->framework->view->page = "player";
            $this->framework->view->content = "/backend/pages/player";
            $this->framework->view->data_player = $model_player->fetch();
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

    /**
     * check player authentication, if the player has been logged in before then redirect to sign in page.
     * role: visitor
     */
    public function login()
    {
        if (Authenticate::is_player()) {
            transport("page/sign/id=" . $_SESSION['ply_key']);
        } else {
            $model_administrator = Authenticate::getInstance();

            /*
             * populate login data like email and password, then set login type for player.
             * use setter method to registering information of authentication.
             */
            $model_administrator->set_email($_POST['log-email']);
            $model_administrator->set_password($_POST['log-password']);
            $model_administrator->set_type(Authenticate::PLAYER);

            /*
             * check player authentication.
             * authentication() function will return an array than contain 2 key,
             * granted {true|false} and state {active|pending}.
             */
            $login = $model_administrator->authenticate();

            /*
             * there are three condition returned into $login variable:
             * 1. credential granted and account has activated, then redirect to sign in page.
             * 2. credential granted but player has not been activated yet, then redirect to the registered page
             *    that contains activation suggestion.
             * 3. credential rejected or email and password mismatched neither active or pending
             *    account will redirected back to the login page.
             */
            $credential = $login["granted"];
            $activated = $login["state"] == Player::ACTIVE;
            $pending = $login["state"] == Player::PENDING;

            if ($credential && $activated) {
                transport("page/sign/id=" . $_SESSION['ply_key']);
            }
            else if ($credential && $pending) {
                $_SESSION['operation'] = 'success';
                transport("page/registered");
            }
            else {
                $_SESSION['operation'] = 'error';
                $_SESSION['message'] = $login["state"];
                transport("page");
            }
        }
    }

    /**
     * logout player session and redirect to home.
     * role: player
     */
    public function logout()
    {
        $auth = Authenticate::getInstance();
        if ($auth->logout(Authenticate::PLAYER)) {
            transport("page");
        } else {
            transport("page/sign/id=" . $_SESSION['ply_id']);
        }
    }

    /**
     * register an user to player, then request activate the account via email
     * role: visitor
     */
    public function register()
    {
        $model_player = Player::getInstance();

        /*
         * populate data into array.
         * generate user token by combining name + email and hash them into unique key.
         * hash password with md5 (it's not a good choice, I will use blowfish algorithm in future).
         * set player state to pending, wait for activate by player
         */
        $data = [
            player::COLUMN_PLY_KEY      => $model_player->generate_key($_POST['reg-name'], $_POST['reg-email']),
            player::COLUMN_PLY_NAME     => $_POST['reg-name'],
            player::COLUMN_PLY_EMAIL    => $_POST['reg-email'],
            player::COLUMN_PLY_PASSWORD => md5($_POST['reg-password']),
            player::COLUMN_PLY_STATE    => player::PENDING
        ];

        session_start();

        /*
         * check email availability on database, when old email exist then suggest to login.
         * instead, passing data that populated before to register then redirect to activation info page.
         */
        if ($model_player->check_email($_POST['reg-email'])) {
            $_SESSION['operation'] = 'error';
            $_SESSION['message'] = 'The email has registered before!';
            transport("page");
        } else {
            if ($model_player->register($data)) {
                $_SESSION['operation'] = 'success';
            } else {
                $_SESSION['operation'] = 'error';
            }
            transport("page/registered");
        }
    }

    /**
     * catch activation link from email site/confirm/{email}/{token}.
     * check token and email combination then redirect to confirmation status
     * role: visitor|player
     */
    public function confirm()
    {
        /*
         * populate data from uri.
         * sitepath/player/email/token
         * part1 / part2 / part3 / part4
         */
        $email = $this->framework->url->url_part(3);
        $key = $this->framework->url->url_part(4);

        $model_player = Player::getInstance();

        session_start();

        /*
         * invoke confirm method from player model and return boolean status.
         * whatever confirmation result will be redirected to page/confirm.
         */
        if ($model_player->confirm($email, $key)) {
            $_SESSION['operation'] = 'success';
        } else {
            $_SESSION['operation'] = 'error';
        }
        transport("page/confirm");
    }

    /**
     * show player details, show achievement and statistic.
     * role: administrator
     * redirected from: Controller.Player.suspend() whatever suspend result
     *                  Controller.Player.reactivate() whatever reactivate result
     */
    public function detail()
    {
        if (Authenticate::is_authorized()) {
            $model_player = Player::getInstance();
            $model_journal = Journal::getInstance();

            $id = $this->framework->url->url_part(3);

            $this->framework->view->page = "player";
            $this->framework->view->content = "/backend/pages/player_detail";
            $this->framework->view->player_detail = $model_player->player_detail($id);
            $this->framework->view->player_summary = $model_player->fetch($id);
            $this->framework->view->player_performance = $model_player->performance($id);
            $this->framework->view->player_finance = $model_journal->finance_summaries($id);
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

    /**
     * show player log and info.
     * role: administrator
     */
    public function logging()
    {
        if (Authenticate::is_authorized()) {
            $model_logging = new Log();

            $id = $this->framework->url->url_part(3);

            $this->framework->view->page = "player";
            $this->framework->view->content = "/backend/pages/player_log";
            $this->framework->view->player_logging = $model_logging->get_log($id);
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

    /**
     * suspend a player temporarily. set session of update status.
     * role: administrator
     */
    public function suspend()
    {
        if (Authenticate::is_authorized()) {
            $model_player = Player::getInstance();

            $id = $this->framework->url->url_part(3);

            if ($model_player->suspend($id)) {
                $_SESSION['operation'] = 'success';
            } else {
                $_SESSION['operation'] = 'error';
            }
            transport("player/detail/$id");
        } else {
            transport("administrator");
        }
    }

    /**
     * activate player state. set session of update status.
     * role: administrator
     */
    public function reactive()
    {
        if (Authenticate::is_authorized()) {
            $model_player = Player::getInstance();

            $id = $this->framework->url->url_part(3);

            if ($model_player->reactive($id)) {
                $_SESSION['operation'] = 'success';
            } else {
                $_SESSION['operation'] = 'error';
            }
            transport("player/detail/$id");
        } else {
            transport("administrator");
        }
    }

    /**
     * export/download player information into pdf
     * role: administrator
     */
    public function get_player_detail()
    {
        if (authenticate::is_authorized()) {
            $model_player = Player::getInstance();

            $id = $this->framework->url->url_part(3);

            $model_report = ReportGenerator::getInstance();
            $model_report->get_report_player_detail($model_player->fetch($id));
            $model_report->print_report();
        } else {
            transport("administrator");
        }
    }

    /**
     * export/download player log into pdf
     * role: administrator
     */
    public function get_player_logging()
    {
        if (authenticate::is_authorized()) {
            $model_logging = Log::getInstance();

            $id = $this->framework->url->url_part(3);

            $model_report = ReportGenerator::getInstance();
            $model_report->get_report_player_log($model_logging->get_log($id));
            $model_report->print_report();
        } else {
            transport("administrator");
        }
    }

    /**
     * update profile on front end page.
     * change name or password.
     * set session of update status.
     * role: player
     */
    public function update_profile()
    {
        if (Authenticate::is_player()) {
            $model_player = Player::getInstance();

            /*
             * populate data and hash password if not empty.
             * double check the password and confirm password has exact same character.
             */
            $data = [player::COLUMN_PLY_NAME => $_POST["sgn-name"]];

            if (isset($_POST['sgn-password']) && !empty($_POST['sgn-password'])) {
                $data[Player::COLUMN_PLY_PASSWORD] = md5($_POST['sgn-password']);
            }

            /*
             * invoke update_profile() method form player model.
             * update player session when profile successfully updated
             */
            if ($model_player->update_profile($data)) {
                $_SESSION['ply_name'] = $_POST["sgn-name"];
                $_SESSION['operation'] = 'success';
            } else {
                $_SESSION['operation'] = 'error';
            }
            transport("page/sign/id=" . $_SESSION['ply_id']);
        } else {
            transport("page");
        }
    }

    /**
     * update player avatar after cropped by javascript on front end page.
     * set session of update status.
     * role: player
     */
    public function update_avatar()
    {
        if (Authenticate::is_player()) {
            $model_player = Player::getInstance();

            if ($model_player->update_avatar()) {
                $_SESSION['operation'] = 'success';
            } else {
                $_SESSION['operation'] = 'error';
            }
            transport("page/sign/id=" . $_SESSION['ply_id']);
        } else {
            transport("page");
        }
    }

    /**
     * delete player and all related data with this player
     * role: administrator
     */
    public function delete()
    {
        if (Authenticate::is_authorized()) {
            $model_player = Player::getInstance();

            $id = $_POST["id"];

            if ($model_player->delete_player($id)) {
                $_SESSION['operation'] = 'success';
            } else {
                $_SESSION['operation'] = 'error';
            }
            transport("player");
        } else {
            transport("administrator");
        }
    }

}