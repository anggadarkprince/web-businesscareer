<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:27 AM
 * To change this template use File | Settings | File Templates.
 */
class administratorController extends Controller
{

    public function index()
    {
        if (Authenticate::is_authorized()) {
            transport("dashboard");
        } else {
            $this->framework->view->show("backend/pages/authenticate");
        }
    }

    public function login()
    {
        if (Authenticate::is_authorized()) {
            transport("dashboard");
        } else {
            $model_administrator = new Authenticate();

            $model_administrator->set_email($_POST['username']);
            $model_administrator->set_password($_POST['password']);
            $model_administrator->set_type(Authenticate::SUPERUSER);

            $login = $model_administrator->authenticate();

            if ($login["granted"] && $login["state"] == User::ACTIVE) {
                transport("dashboard");
            } else {
                $_SESSION['operation'] = 'error';
                $_SESSION['message'] = $login["state"];
                transport("administrator");
            }
        }
    }

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