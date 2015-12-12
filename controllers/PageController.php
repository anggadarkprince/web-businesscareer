<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class PageController extends Controller
{
    // define constant as sign for sub/fragment on home page
    const HOME = "home";
    const REGISTERED = "registered";
    const CONFIRM = "confirm";
    const SIGN = "sign";

    /**
     * default page when user access the web.
     * it will redirect to Controller.Page.sign() if player session is exist.
     * role: visitor
     * redirected from: Controller.Player.register() if email has been registered before
     *                  Controller.Player.login() if the credential is denied
     *                  Controller.Player.logout() default redirecting page
     */
    public function index()
    {
        if (authenticate::is_player()) {
            transport("page/sign");
        } else {
            $this->framework->view->page = "index";
            $this->framework->view->section = PageController::HOME;
            $this->framework->view->content = "/frontend/pages/index";
            $this->framework->view->show("frontend/template");
        }
    }

    /**
     * after user complete the registration proceed, user will pass through to this page.
     * if user try to login but the account has not been confirmed yet, then it will pass this too.
     * role: visitor
     * redirected from: Controller.Player.register() if registering success
     *                  Controller.Player.login() if user has not been activated the account yet
     */
    public function registered()
    {
        $this->framework->view->page = "index";
        $this->framework->view->section = PageController::REGISTERED;
        $this->framework->view->content = "/frontend/pages/index";
        $this->framework->view->show("frontend/template");
    }

    /**
     * this page does not proceed account activation, just show information from activation process.
     * player confirm a link via email then make a request to sitepath/player/confirm/{email}/{token}.
     * role: visitor
     * redirected from: Controller.Player.confirm() whatever result of activation
     */
    public function confirm()
    {
        $this->framework->view->page = "index";
        $this->framework->view->section = PageController::CONFIRM;
        $this->framework->view->content = "/frontend/pages/index";
        $this->framework->view->show("frontend/template");
    }

    /**
     * after user has logged in, player will redirected this page.
     * if the player session exist then player click home in navigation then redirected here too.
     * role: player
     * redirected from: Controller.Page.index() if user session is exist
     *                  Controller.Player.login() if credential is granted
     */
    public function sign()
    {
        if (Authenticate::is_player()) {
            $model_leaderboard = Leaderboard::getInstance();

            $this->framework->view->page = "index";
            $this->framework->view->section = PageController::SIGN;
            $this->framework->view->content = "/frontend/pages/index";
            $this->framework->view->summary = $model_leaderboard->get_player_ranking();
            $this->framework->view->show("frontend/template");
        } else {
            transport("page");
        }
    }

    /**
     * show game page via user profile.
     * game could be played if user has been logged in.
     * role: player
     */
    public function game()
    {
        if (authenticate::is_player()) {
            $this->framework->view->page = "game";
            $this->framework->view->content = "/frontend/pages/game";
            $this->framework->view->show("frontend/game");

            $log = Log::getInstance();
            $log->logging_web_play(uniqid());
        } else {
            transport("page");
        }
    }

    /**
     * show accounting page via navigation menu.
     * role: visitor
     */
    public function accounting()
    {
        $this->framework->view->page = "accounting";
        $this->framework->view->content = "/frontend/pages/accounting";
        $this->framework->view->show("frontend/template");
    }

    /**
     * show serious game page via navigation menu.
     * role: visitor
     */
    public function seriousgame()
    {
        $this->framework->view->page = "seriousgame";
        $this->framework->view->content = "/frontend/pages/seriousgame";
        $this->framework->view->show("frontend/template");
    }

    /**
     * show contact page via navigation menu.
     * role: visitor|administrator
     */
    public function contact()
    {
        $this->framework->view->page = "contact";
        $this->framework->view->content = "/frontend/pages/contact";
        $this->framework->view->show("frontend/template");
    }

    /**
     * show privacy page from game page and administrator.
     * role: player|administrator
     */
    public function privacy()
    {
        $this->framework->view->page = "privacy";
        $this->framework->view->content = "/frontend/pages/privacy";
        $this->framework->view->show("frontend/template");
    }

    /**
     * show disclaimer page from game page and administrator.
     * role: player|administrator
     */
    public function disclaimer()
    {
        $this->framework->view->page = "privacy";
        $this->framework->view->content = "/frontend/pages/disclaimer";
        $this->framework->view->show("frontend/template");
    }

    /**
     * show agreement page from game page and administrator.
     * role: player|administrator
     */
    public function agreement()
    {
        $this->framework->view->page = "privacy";
        $this->framework->view->content = "/frontend/pages/agreement";
        $this->framework->view->show("frontend/template");
    }

}