<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 */
class StatisticController extends Controller
{
    /**
     * show statistic top 10 of player from sidebar navigation
     * role: administrator
     */
    public function index()
    {
        if (authenticate::is_authorized()) {
            $model_player = Player::getInstance();
            $model_leaderboard = Leaderboard::getInstance();

            $model_player->get_total_player();
            $model_player->unread_new_player();
            $this->framework->view->page = "statistic";
            $this->framework->view->content = "/backend/pages/statistic";
            $this->framework->view->leaderboard = $model_leaderboard->get_top10_ranking();
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

    /**
     * export/download top 10 player into pdf
     * role: administrator
     */
    public function get_player_top_10()
    {
        if (authenticate::is_authorized()) {
            $model_report = new ReportGenerator();
            $model_leaderboard = Leaderboard::getInstance();

            $model_report->get_report_top_10($model_leaderboard->get_top10_ranking());
            $model_report->print_report();
        } else {
            transport("administrator");
        }
    }
}