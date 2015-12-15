<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Achievement extends Model
{
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
     * @return null|object|Achievement
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Achievement();
        }
        return self::$instance;
    }

    /**
     * retrieve player's achievement when load data.
     * invoked by: Controller.GameServer.load_data()
     * @return null
     */
    public function get_achievement()
    {
        $player = $_SESSION['ply_id'];
        $query = "
          SELECT
            ach_id,
            ach_achievement,
            ach_description,
            ach_reward,
            CONCAT('achievement_', LCASE(ach_achievement)) as ac_title_atlas,
            ach_atlas, IFNULL(earned,0) as earned

          FROM
            bc_achievement

          LEFT JOIN
            (
              SELECT
                pac_achievement,
                COUNT(pac_id) as earned

              FROM
                bc_player_achievement

              WHERE pac_player = $player
              GROUP BY pac_achievement
            ) bc_player_achievement

            ON ach_id = pac_achievement ORDER BY ach_id
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return null;
        }
    }

    /**
     * save new achievement into database.
     * invoked by: Controller.Achievement.unlock_achievement()
     * @param $achievement
     * @return bool
     */
    public function unlock_achievement($achievement)
    {
        $data = array(
            "pac_player" => $_SESSION['ply_id'],
            "pac_achievement" => $achievement,
        );
        return $this->Create(Utility::TABLE_PLAYER_ACHIEVEMENT, $data);
    }

}