<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class LeaderboardController extends Controller
{
    private $model_leaderboard;

    public function index()
    {
        transport("error404");
    }

    public function retrieve_leaderboard()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_leaderboard = Leaderboard::getInstance();
                $player_ranking = $this->model_leaderboard->get_player_ranking();
                $global_ranking = $this->model_leaderboard->get_global_ranking();

                $binding = array(
                    "result_var" => "session_ready",
                    "leaderboard_player_var" => json_encode($player_ranking),
                    "leaderboard_global_var" => json_encode($global_ranking)
                );

                Utility::pretty_print($global_ranking);
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

}