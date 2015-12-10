<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Leaderboard extends Model
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
     * @return null|object|Leaderboard
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Leaderboard();
        }
        return self::$instance;
    }

    public function get_player_ranking($player_id = null)
    {
        if ($player_id == null) {
            $player = $_SESSION['ply_id'];
        } else {
            $player = $player_id;
        }

        //SET @counter = 0;
        $query = "
            SELECT * FROM
            (
                SELECT
                  (@counter := @counter +1) as ranking,
                  ply_id,
                  ply_name,
                  ply_avatar,
                  gme_point,
                  gme_cash,
                  star
                FROM bc_game_data

                INNER JOIN bc_player
                  ON gme_player = ply_id

                INNER JOIN
                  (
                    SELECT
                      pac_player,
                      CEILING(COUNT(pac_player)/2) AS star
                    FROM
                      (
                        SELECT
                        IFNULL(pac_player,gme_player) as pac_player
                        FROM bc_game_data LEFT JOIN bc_player_achievement
                        ON gme_player = pac_player
                        GROUP BY pac_achievement,gme_player
                        ORDER BY pac_player
                      ) player_achievement

                    GROUP BY pac_player
                  ) ply_star
                  ON ply_id = pac_player

                ORDER BY gme_point DESC LIMIT 5
            ) ranking
        ";

        $result = $this->ManualQuery($query);

        if ($result && $this->CountRow() > 0) {
            $data = $this->FetchData();
            for ($i = 0; $i < sizeof($data); $i++) {
                $data[$i][0] = $i + 1;
                $data[$i]["ranking"] = $i + 1;

                if ($data[$i]["ply_id"] == $player) {
                    return $data[$i];
                }
            }
            return null;
        } else {
            return null;
        }
    }

    public function get_global_ranking($top = null)
    {
        if ($top == null) {
            $limit = 5;
        } else {
            $limit = $top;
        }

        //SET @counter = 0;
        $query = "
            SELECT
    		  (@counter := @counter +1) as ranking,
              ply_id,
              ply_name,
              ply_avatar,
              gme_point,
              gme_cash,
              star
            FROM bc_game_data

            INNER JOIN bc_player
              ON gme_player = ply_id

            INNER JOIN
              (
                SELECT
                  pac_player,
                  CEILING(COUNT(pac_player)/2) AS star
                FROM
                  (
                    SELECT
                    IFNULL(pac_player,gme_player) as pac_player
                    FROM bc_game_data LEFT JOIN bc_player_achievement
                    ON gme_player = pac_player
                    GROUP BY pac_achievement,gme_player
                    ORDER BY pac_player
                  ) player_achievement

                GROUP BY pac_player
              ) ply_star
              ON ply_id = pac_player

            WHERE ply_state = 'ACTIVE'
            ORDER BY gme_point DESC LIMIT $limit
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            $data = $this->FetchData();
            for ($i = 0; $i < sizeof($data); $i++) {
                $data[$i][0] = $i + 1;
                $data[$i]["ranking"] = $i + 1;
            }
            return $data;
        } else {
            return null;
        }
    }


    public function get_top10_ranking()
    {
        $query = "
            SELECT
              ply_id,
              ply_avatar,
              ply_name,
              ply_email,
              IFNULL(star,1) as ply_star,
              IFNULL(gme_cash,0) as ply_cash,
              IFNULL(gme_point,0) as ply_point,
              ply_state

            FROM bc_player

            LEFT JOIN
            (
              SELECT
                pac_player,
                CEILING(COUNT(pac_player)/2) AS star
              FROM
              (
                SELECT
                  IFNULL(pac_player,gme_player) as pac_player
                  FROM bc_game_data LEFT JOIN bc_player_achievement
                  ON gme_player = pac_player
                  GROUP BY pac_achievement,gme_player
                  ORDER BY pac_player
              ) player_achievement

              GROUP BY pac_player
            ) star
              ON ply_id = pac_player

            LEFT JOIN bc_game_data
              ON ply_id = gme_player

            WHERE ply_state = 'ACTIVE'
            LIMIT 10
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            $data = $this->FetchData();
            for ($i = 0; $i < sizeof($data); $i++) {
                $data[$i][0] = $i + 1;
                $data[$i]["ranking"] = $i + 1;
            }
            return $data;
        } else {
            return null;
        }
    }
}