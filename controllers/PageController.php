<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class pageController extends Controller
{

    const HOME = "home";
    const REGISTERED = "registered";
    const CONFIRM = "confirm";
    const SIGN = "sign";

    private $model_leaderboard;

    public function index()
    {
        if (authenticate::is_player()) {
            transport("page/sign");
        } else {
            $this->framework->view->page = "index";
            $this->framework->view->section = pageController::HOME;
            $this->framework->view->content = "/frontend/pages/index";
            $this->framework->view->show("frontend/template");
        }
    }

    public function registered()
    {
        $this->framework->view->page = "index";
        $this->framework->view->section = pageController::REGISTERED;
        $this->framework->view->content = "/frontend/pages/index";
        $this->framework->view->show("frontend/template");
    }

    public function confirm()
    {
        $this->framework->view->page = "index";
        $this->framework->view->section = pageController::CONFIRM;
        $this->framework->view->content = "/frontend/pages/index";
        $this->framework->view->show("frontend/template");
    }

    public function sign()
    {
        if (Authenticate::is_player()) {
            $this->model_leaderboard = Leaderboard::getInstance();

            $this->framework->view->page = "index";
            $this->framework->view->section = pageController::SIGN;
            $this->framework->view->content = "/frontend/pages/index";
            $this->framework->view->summary = $this->model_leaderboard->get_player_ranking();
            $this->framework->view->show("frontend/template");
        } else {
            transport("page");
        }
    }

    public function game()
    {
        if (authenticate::is_player()) {
            $this->framework->view->page = "game";
            $this->framework->view->content = "/frontend/pages/game";
            $this->framework->view->show("frontend/game");

            // create play log
            $log = Log::getInstance();
            $log->logging_web_play(uniqid());
        } else {
            transport("page");
        }
    }


    public function accounting()
    {
        $this->framework->view->page = "accounting";
        $this->framework->view->content = "/frontend/pages/accounting";
        $this->framework->view->show("frontend/template");
    }

    public function seriousgame()
    {
        $this->framework->view->page = "seriousgame";
        $this->framework->view->content = "/frontend/pages/seriousgame";
        $this->framework->view->show("frontend/template");
    }

    public function contact()
    {
        $this->framework->view->page = "contact";
        $this->framework->view->content = "/frontend/pages/contact";
        $this->framework->view->show("frontend/template");
    }


    public function privacy()
    {
        $this->framework->view->page = "privacy";
        $this->framework->view->content = "/frontend/pages/privacy";
        $this->framework->view->show("frontend/template");
    }

    public function disclaimer()
    {
        $this->framework->view->page = "privacy";
        $this->framework->view->content = "/frontend/pages/disclaimer";
        $this->framework->view->show("frontend/template");
    }

    public function agreement()
    {
        $this->framework->view->page = "privacy";
        $this->framework->view->content = "/frontend/pages/agreement";
        $this->framework->view->show("frontend/template");
    }


}