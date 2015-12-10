<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class dashboardController extends Controller
{

    public function index()
    {
        if (authenticate::is_authorized()) {
            $model_player = Player::getInstance();

            $model_player->get_total_player();
            $model_player->unread_new_player();

            $this->framework->view->page = "dashboard";
            $this->framework->view->content = "/backend/pages/dashboard";
            $this->framework->view->registration_statistic = $model_player->registration_statistic();
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

    public function setting()
    {
        if (authenticate::is_authorized()) {
            $model_administrator = Administrator::getInstance();
            $model_user = User::getInstance();

            $this->framework->view->page = "setting";
            $this->framework->view->content = "/backend/pages/setting";
            $this->framework->view->data_setting = $model_administrator->retrieve_setting();
            $this->framework->view->data_user = $model_user->retrieve_user();
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

    public function about()
    {
        if (authenticate::is_authorized()) {
            $this->framework->view->page = "about";
            $this->framework->view->content = "/backend/pages/about";
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }


    public function profile_update()
    {
        if (authenticate::is_authorized()) {
            $model_user = User::getInstance();

            $data = array(
                User::COLUMN_USR_PASSWORD => md5($_POST["profile_password"]),
                User::COLUMN_USR_NAME => $_POST["profile_name"],
                User::COLUMN_USR_ABOUT => $_POST["profile_about"],
                User::COLUMN_USR_GENDER => $_POST["profile_gender"],
            );

            if ($model_user->check_authorize_update(md5($_POST["profile_password"]))) {
                if (isset($_POST["profile_newpassword"]) && !empty($_POST["profile_newpassword"])) {
                    $data[User::COLUMN_USR_PASSWORD] = md5($_POST["profile_newpassword"]);
                }

                if ($model_user->update_user($data)) {
                    $_SESSION['profile_operation'] = 'success';
                } else {
                    $_SESSION['profile_operation'] = 'error';
                }
            } else {
                $_SESSION['profile_operation'] = 'warning';
            }

            transport("dashboard/setting");
        } else {
            transport("administrator");
        }
    }


    public function setting_update()
    {
        if (authenticate::is_authorized()) {
            $model_administrator = Administrator::getInstance();

            $data = array(
                Administrator::COLUMN_STG_NAME => $_POST["website_name"],
                Administrator::COLUMN_STG_DESCRIPTION => $_POST["website_description"],
                Administrator::COLUMN_STG_KEYWORD => $_POST["website_keyword"],
                Administrator::COLUMN_STG_EMAIL => $_POST["website_email"],
                Administrator::COLUMN_STG_NUMBER => $_POST["website_number"],
                Administrator::COLUMN_STG_ADDRESS => $_POST["website_address"],
                Administrator::COLUMN_STG_FACEBOOK => $_POST["website_facebook"],
                Administrator::COLUMN_STG_TWITTER => $_POST["website_twitter"]
            );

            if ($model_administrator->update_setting($data)) {
                $_SESSION['setting_operation'] = 'success';
            } else {
                $_SESSION['setting_operation'] = 'error';
            }

            transport("dashboard/setting");
        } else {
            transport("administrator");
        }
    }

}