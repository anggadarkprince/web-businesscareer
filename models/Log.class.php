<?php

/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 6/6/14
 * Time: 2:22 PM
 */
class Log extends Model
{
    const COLUMN_LGG_ID = "lgg_id";
    const COLUMN_LGG_MODULE = "lgg_module";
    const COLUMN_LGG_OPERATION = "lgg_operation";
    const COLUMN_LGG_VALUE = "lgg_value";
    const COLUMN_LGG_PLAYER = "lgg_player";
    const COLUMN_LGG_UPDATED_AT = "lgg_updated_at";
    const COLUMN_LGG_CREATED_AT = "lgg_created_at";

    const MODULE_GAME_SETUP = "MODULE_GAME_SIMULATION";
    const MODULE_GAME_SIMULATION = "MODULE_GAME_SIMULATION";
    const MODULE_GAME_EARN_ACHIEVEMENT = "MODULE_GAME_EARN_ACHIEVEMENT";
    const MODULE_GAME_SAVE = "MODULE_GAME_SAVE";
    const MODULE_GAME_LOAD = "MODULE_GAME_LOAD";

    const MODULE_WEB_AUTH = "MODULE_WEB_AUTH";
    const MODULE_WEB_DESTROY = "MODULE_WEB_DESTROY";
    const MODULE_WEB_PROFILE = "MODULE_WEB_CHANGE_PROFILE";
    const MODULE_WEB_REGISTRATION = "MODULE_WEB_REGISTRATION";
    const MODULE_WEB_CONFIRM = "MODULE_WEB_CONFIRM";
    const MODULE_WEB_PLAY = "MODULE_WEB_PLAY_GAME";

    const OPERATION_INSERT = "INSERT";
    const OPERATION_UPDATE = "UPDATE";
    const OPERATION_REMOVE = "REMOVE";
    const OPERATION_RETRIEVE = "RETRIEVE";

    // applied singleton pattern
    private static $instance = NULL;

    /**
     * default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null|object|Log
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Log();
        }
        return self::$instance;
    }

    /**
     * save game log when player play the game for the first time.
     * invoked by: Controller.GameServer.setup_data()
     * @param $data
     * @return bool
     */
    public function logging_game_setup($data)
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_GAME_SETUP,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_INSERT,
            Log::COLUMN_LGG_VALUE => $data,
            Log::COLUMN_LGG_PLAYER => $_SESSION['ply_id']
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when play new simulation.
     * invoked by: Controller.GameServer.insert_simulation()
     * @param $data
     * @return bool
     */
    public function logging_game_simulation($data)
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_GAME_SIMULATION,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_INSERT,
            Log::COLUMN_LGG_VALUE => $data,
            Log::COLUMN_LGG_PLAYER => $_SESSION['ply_id']
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when unlock achievement.
     * invoked by: Controller.Achievement.unlock_achievement()
     * @param $data
     * @return bool
     */
    public function logging_game_earn_achievement($data)
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_GAME_EARN_ACHIEVEMENT,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_INSERT,
            Log::COLUMN_LGG_VALUE => $data,
            Log::COLUMN_LGG_PLAYER => $_SESSION['ply_id']
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when game is saved.
     * invoked by: Controller.GameServer.save_data()
     * @param $data
     * @return bool
     */
    public function logging_game_save($data)
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_GAME_SAVE,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_INSERT,
            Log::COLUMN_LGG_VALUE => $data,
            Log::COLUMN_LGG_PLAYER => $_SESSION['ply_id']
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when game is loaded.
     * invoked by: Controller.GameServer.load_data()
     * @param $data
     * @return bool
     */
    public function logging_game_load($data)
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_GAME_LOAD,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_RETRIEVE,
            Log::COLUMN_LGG_VALUE => $data,
            Log::COLUMN_LGG_PLAYER => $_SESSION['ply_id']
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when player is logged in.
     * invoked by: Model.Authenticate.authenticate()
     * @return bool
     */
    public function logging_web_auth()
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_WEB_AUTH,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_RETRIEVE,
            Log::COLUMN_LGG_VALUE => $_SESSION['ply_username'],
            Log::COLUMN_LGG_PLAYER => $_SESSION['ply_id']
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when player is logged out
     * invoked by: Model.Authenticate.logout()
     * @return bool
     */
    public function logging_web_destroy()
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_WEB_DESTROY,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_RETRIEVE,
            Log::COLUMN_LGG_VALUE => $_SESSION['ply_username'],
            Log::COLUMN_LGG_PLAYER => $_SESSION['ply_id']
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when player updates their profile
     * invoked by: Model.Player.update_profile()
     *             Model.Player.update_avatar()
     * @param $data
     * @return bool
     */
    public function logging_web_profile($data)
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_WEB_PROFILE,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_UPDATE,
            Log::COLUMN_LGG_VALUE => $data,
            Log::COLUMN_LGG_PLAYER => $_SESSION['ply_id']
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when the user has registered
     * invoked by: Model.Player.register()
     * @param $id
     * @param $data
     * @return bool
     */
    public function logging_web_registration($id, $data)
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_WEB_REGISTRATION,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_INSERT,
            Log::COLUMN_LGG_VALUE => $data,
            Log::COLUMN_LGG_PLAYER => $id
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when the user confirms the registration
     * invoked by: Model.Player.confirm()
     * @param $id
     * @param $data
     * @return bool
     */
    public function logging_web_confirm($id, $data)
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_WEB_CONFIRM,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_UPDATE,
            Log::COLUMN_LGG_VALUE => $data,
            Log::COLUMN_LGG_PLAYER => $id
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * save game log when the user confirms the registration
     * invoked by: Controller.Page.game()
     * @param $data
     * @return bool
     */
    public function logging_web_play($data)
    {
        $data = array(
            Log::COLUMN_LGG_MODULE => Log::MODULE_WEB_PLAY,
            Log::COLUMN_LGG_OPERATION => Log::OPERATION_RETRIEVE,
            Log::COLUMN_LGG_VALUE => $data,
            Log::COLUMN_LGG_PLAYER => $_SESSION['ply_id']
        );
        return $this->Create(Utility::TABLE_LOGGING, $data);
    }

    /**
     * retrieve player's log from database.
     * invoked by: Controller.Player.logging()
     * @param $player
     * @return array
     */
    public function get_log($player)
    {
        $result = $this->ReadWhere(Utility::TABLE_LOGGING, array(Log::COLUMN_LGG_PLAYER => $player));
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

    /**
     * retrieve last 10 logging data.
     * @return array
     */
    public function logging_statistic()
    {
        $query = "SELECT
                    date(" . Log::COLUMN_LGG_CREATED_AT . ") as date,
                    COUNT(" . Log::COLUMN_LGG_ID . ")/10 as total

                    FROM
                        " . Utility::TABLE_LOGGING . "

                        GROUP BY date(" . Log::COLUMN_LGG_CREATED_AT . ")

                        LIMIT 10";

        if ($this->ManualQuery($query)) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

} 