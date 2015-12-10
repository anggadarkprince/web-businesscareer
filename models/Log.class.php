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
    function __construct()
    {
        parent::__construct();
    }

    /**
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
     * @param $player
     * @return null
     */
    public function get_log($player)
    {
        $result = $this->ReadWhere(Utility::TABLE_LOGGING, array(Log::COLUMN_LGG_PLAYER => $player));
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return null;
        }
    }

    /**
     * @return null
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
            return null;
        }
    }

} 