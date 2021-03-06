<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 */
class ReportController extends Controller
{
    /**
     * show report table overall from sidebar navigation.
     * role: administrator
     */
    public function index()
    {
        if (Authenticate::is_authorized()) {
            $model_player = Player::getInstance();
            $model_feedback = Feedback::getInstance();
            $model_administrator = Administrator::getInstance();

            $model_player->get_total_player();
            $model_player->unread_new_player();

            $this->framework->view->page = "report";
            $this->framework->view->player = $model_player->get_player_report();
            $this->framework->view->feedback = $model_feedback->retrieve_feedback_report();
            $this->framework->view->traffic = $model_administrator->retrieve_traffic_report();
            $this->framework->view->chart = $model_administrator->retrieve_traffic_chart_data();
            $this->framework->view->content = "/backend/pages/report";
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

    /**
     * export/download overall report into pdf
     * role: administrator
     */
    public function get_overall()
    {
        if (Authenticate::is_authorized()) {
            $model_player = Player::getInstance();
            $model_feedback = Feedback::getInstance();
            $model_administrator = Administrator::getInstance();
            $model_leaderboard = Leaderboard::getInstance();

            $model_report = new ReportGenerator();

            $model_report->get_report_overall($model_player->get_player_report(), $model_feedback->retrieve_feedback_report(), $model_administrator->retrieve_traffic_report(), $model_leaderboard->get_top10_ranking());
            $model_report->print_report();
        } else {
            transport("administrator");
        }
    }
}