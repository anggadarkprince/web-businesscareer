<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class playerController extends Controller
{

    public function index()
    {
        if (Authenticate::is_authorized()) {
            $model_player = new player();
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

    public function login()
    {
        if (Authenticate::is_player()) {
            transport("page/sign/id=" . $_SESSION['ply_key']);
        } else {
            $model_administrator = new Authenticate();

            $model_administrator->set_email($_POST['log-email']);
            $model_administrator->set_password($_POST['log-password']);
            $model_administrator->set_type(Authenticate::PLAYER);

            $login = $model_administrator->authenticate();

            if ($login["granted"] && $login["state"] == player::ACTIVE) {
                transport("page/sign/id=" . $_SESSION['ply_key']);
            } else if ($login["granted"] && $login["state"] == player::PENDING) {
                $_SESSION['operation'] = 'success';
                transport("page/registered");
            } else {
                $_SESSION['operation'] = 'error';
                $_SESSION['message'] = $login["state"];
                transport("page");
            }
        }
    }

    public function logout()
    {
        $auth = new Authenticate();
        if ($auth->logout(Authenticate::PLAYER)) {
            transport("page");
        } else {
            transport("page/sign/id=" . $_SESSION['ply_id']);
        }
    }

    public function register()
    {
        $model_player = new player();

        $data = array(
            player::COLUMN_PLY_KEY => $model_player->generate_key($_POST['reg-name'], $_POST['reg-email']),
            player::COLUMN_PLY_NAME => $_POST['reg-name'],
            player::COLUMN_PLY_EMAIL => $_POST['reg-email'],
            player::COLUMN_PLY_PASSWORD => md5($_POST['reg-password']),
            player::COLUMN_PLY_STATE => player::PENDING
        );

        session_start();
        if ($model_player->check_email($_POST['reg-email'])) {
            $_SESSION['operation'] = 'error';
            $_SESSION['message'] = 'Email has registered before!';
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

    public function confirm()
    {
        $email = $this->framework->url->url_part(3);
        $key = $this->framework->url->url_part(4);

        $model_player = new player();

        session_start();
        if ($model_player->confirm($email, $key)) {
            $_SESSION['operation'] = 'success';
        } else {
            $_SESSION['operation'] = 'error';
        }
        transport("page/confirm");
    }

    public function detail()
    {
        if (Authenticate::is_authorized()) {
            $model_player = Player::getInstance();

            $id = $this->framework->url->url_part(3);

            $this->framework->view->page = "player";
            $this->framework->view->content = "/backend/pages/player_detail";
            $this->framework->view->player_detail = $model_player->player_detail($id);
            $this->framework->view->player_summary = $model_player->fetch($id);
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

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

    public function suspend()
    {
        if (Authenticate::is_authorized()) {
            $model_player = new player();

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

    public function reactive()
    {
        if (Authenticate::is_authorized()) {
            $model_player = new player();

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

    public function update_profile()
    {
        if (Authenticate::is_player()) {
            $model_player = new player();

            $data = array(
                player::COLUMN_PLY_NAME => $_POST["sgn-name"]
            );

            if (isset($_POST['sgn-password']) && !empty($_POST['sgn-password'])) {
                $data[Player::COLUMN_PLY_PASSWORD] = md5($_POST['sgn-password']);
            }

            if ($model_player->update_profile($data)) {
                $_SESSION['play_name'] = $_POST["sgn-name"];
                $_SESSION['operation'] = 'success';
            } else {
                $_SESSION['operation'] = 'error';
            }
            transport("page/sign/id=" . $_SESSION['ply_id']);
        } else {
            transport("page");
        }
    }

    public function update_avatar()
    {
        if (Authenticate::is_player()) {
            $model_player = new player();
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

}