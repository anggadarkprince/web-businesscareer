<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class reportController extends Controller
{

    public function index()
    {
        if (authenticate::is_authorized()) {
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

    public function get_player_detail()
    {
        if (authenticate::is_authorized()) {
            $model_player = new player();

            $id = $this->framework->url->url_part(3);

            $model_report = new ReportGenerator();
            $model_report->get_report_player_detail($model_player->fetch($id));
            $model_report->print_report();
        } else {
            transport("administrator");
        }
    }

    public function get_player_logging()
    {
        if (authenticate::is_authorized()) {
            $model_logging = new Log();

            $id = $this->framework->url->url_part(3);

            $model_report = new ReportGenerator();
            $model_report->get_report_player_log($model_logging->get_log($id));
            $model_report->print_report();
        } else {
            transport("administrator");
        }
    }

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

    public function get_overall()
    {
        if (authenticate::is_authorized()) {
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