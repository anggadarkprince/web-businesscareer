<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class statisticController extends Controller
{

    public function index()
    {
        if (authenticate::is_authorized()) {
            $model_player = Player::getInstance();
            $model_leaderboard = Leaderboard::getInstance();

            $model_player->total_player();
            $model_player->unread_new_player();
            $this->framework->view->page = "statistic";
            $this->framework->view->content = "/backend/pages/statistic";
            $this->framework->view->leaderboard = $model_leaderboard->get_top10_ranking();
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

}