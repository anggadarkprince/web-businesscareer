<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 */
class DashboardController extends Controller
{
    /**
     * default administrator index page, show chart from sidebar navigation.
     * role: administrator
     * redirected from: Controller.Administrator.login() if credential is granted
     *                  Controller.Administrator.logout() if destroy session is failed
     *                  Controller.Administrator.index() if administrator session is exist
     */
    public function index()
    {
        if (Authenticate::is_authorized()) {
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

    /**
     * show setting page and load setting data from sidebar navigation.
     * role: administrator
     * redirected from: Controller.Dashboard.profile_update() whatever profile update result
     *                  Controller.Dashboard.setting_update() whatever setting update result
     */
    public function setting()
    {
        if (Authenticate::is_authorized()) {
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

    /**
     * show about page from backend navigation menu and tap on header.
     * role: administrator
     */
    public function about()
    {
        if (Authenticate::is_authorized()) {
            $this->framework->view->page = "about";
            $this->framework->view->content = "/backend/pages/about";
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }


    /**
     * update profile data from setting page.
     * role: administrator
     */
    public function profile_update()
    {
        if (Authenticate::is_authorized()) {
            $model_user = User::getInstance();

            /*
             * populate data from post request.
             * hash password with md5 (it's worst practice, in future use blowfish algorithm)
             */
            $data = [
                User::COLUMN_USR_PASSWORD   => md5($_POST["profile_password"]),
                User::COLUMN_USR_NAME       => $_POST["profile_name"],
                User::COLUMN_USR_ABOUT      => $_POST["profile_about"],
                User::COLUMN_USR_GENDER     => $_POST["profile_gender"],
            ];

            /*
             * update profile need to include the old password to prevent unauthorized user get rid your profile.
             * if [profile_newpassword] is not empty then user has intention to make the new one.
             * there are 3 condition that returned to setting page:
             * 1. update success then given sign 'success' into session
             * 2. update failed then given sign 'error' into session
             * 3. old password mismatch with active user session then given 'warning' into session
             */
            if ($model_user->check_authorize_update(md5($_POST["profile_password"])))
            {
                if (isset($_POST["profile_newpassword"]) && !empty($_POST["profile_newpassword"])) {
                    $data[User::COLUMN_USR_PASSWORD] = md5($_POST["profile_newpassword"]);
                }

                /*
                 * invoke update_user() in user model.
                 * check return value that indicate administrator profile update or not
                 */
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

    /**
     * update profile data from setting page.
     * role: administrator
     */
    public function setting_update()
    {
        if (Authenticate::is_authorized()) {
            $model_administrator = Administrator::getInstance();

            /*
             * populate data from post request.
             * make sure form data match with setting keys
             */
            $data = [
                Administrator::COLUMN_STG_NAME          => $_POST["website_name"],
                Administrator::COLUMN_STG_DESCRIPTION   => $_POST["website_description"],
                Administrator::COLUMN_STG_KEYWORD       => $_POST["website_keyword"],
                Administrator::COLUMN_STG_EMAIL         => $_POST["website_email"],
                Administrator::COLUMN_STG_NUMBER        => $_POST["website_number"],
                Administrator::COLUMN_STG_ADDRESS       => $_POST["website_address"],
                Administrator::COLUMN_STG_FACEBOOK      => $_POST["website_facebook"],
                Administrator::COLUMN_STG_TWITTER       => $_POST["website_twitter"]
            ];

            /*
             * invoke update_setting() method in administrator model.
             * check the return value that indicate upload favicon and update database are success
             */
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