<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:27 AM
 */
class AdministratorController extends Controller
{
    /**
     * show login page for administrator.
     * it will redirect to Controller.Dashboard.index() if administrator session is exist.
     * role: administrator
     * redirected from: Controller.Administrator.login() if credential is denied
     *                  Controller.Administrator.logout() if session is destroyed
     *                  all possibilities request that need administrator to login
     */
    public function index()
    {
        if (Authenticate::is_authorized()) {
            transport("dashboard");
        } else {
            $this->framework->view->show("backend/pages/authenticate");
        }
    }

    /**
     * check administrator authentication
     * role: administrator
     */
    public function login()
    {
        if (Authenticate::is_authorized()) {
            transport("dashboard");
        } else {
            $model_administrator = new Authenticate();

            /*
             * populate login data for administrator
             * use setter method to registering information of authentication
             */
            $model_administrator->set_email($_POST['username']);
            $model_administrator->set_password($_POST['password']);
            $model_administrator->set_type(Authenticate::SUPERUSER);

            $login = $model_administrator->authenticate();

            /*
             * $login variable contain array which have 2 keys [granted] and [state]
             * granted {true|false} and state {active|pending}
             * just grant credential that return active and match email and password
             */
            if ($login["granted"] && $login["state"] == User::ACTIVE) {
                transport("dashboard");
            } else {
                $_SESSION['operation'] = 'error';
                $_SESSION['message'] = $login["state"];
                transport("administrator");
            }
        }
    }

    /**
     * destroy administrator session
     * role: administrator
     */
    public function logout()
    {
        $auth = new Authenticate();
        if ($auth->logout(Authenticate::SUPERUSER)) {
            transport("administrator");
        } else {
            transport("dashboard");
        }
    }
}