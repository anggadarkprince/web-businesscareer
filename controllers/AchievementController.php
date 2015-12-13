<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class AchievementController extends Controller
{
    private $model_achievement;

    /**
     * prevent access this route via browser
     */
    public function index()
    {
        transport("error404");
    }

    /**
     * save new achievement via REST.
     * role: player
     */
    public function unlock_achievement()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_achievement = Achievement::getInstance();

                /*
                 * populate type of achievement.
                 * invoke method to unlock the achievement.
                 * log this event about achievement earning.
                 */
                $achievement = $_POST["achievement"];

                $result = $this->model_achievement->unlock_achievement($achievement);

                $log = Log::getInstance();
                $log->logging_game_earn_achievement("Achievement id $achievement");

                $binding = array(
                    "result_var" => "session_ready",
                    "unlock_status" => $result
                );
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