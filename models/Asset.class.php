<?php
/**
 * Created by PhpStorm.
 * User: Adinda
 * Date: 1/7/15
 * Time: 12:27 AM
 */

class Asset extends Model{

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
     * @return null|object|Product
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Asset();
        }
        return self::$instance;
    }

    /**
     * initializing asset when open game for the first time
     */
    public function initialize_asset()
    {
        $query = "
            SELECT
              ast_id
            FROM bc_asset
            GROUP BY ast_type
            ORDER BY ast_id
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            $initial_asset = $this->FetchData();
        } else {
            $initial_asset = null;
        }

        foreach ($initial_asset as $attribute) {
            $data = array(
                "pas_player" => $_SESSION['ply_id'],
                "pas_asset" => $attribute["ast_id"],
            );
            $this->Create(Utility::TABLE_PLAYER_ASSET, $data);
        }
    }

    /**
     * @return null
     */
    public function get_asset_data()
    {
        $query = "
            SELECT
              ast_id,
              ast_type,
              ast_asset,
              ast_atlas,
              ast_price,
              ast_level,
              ast_description,
              ast_economic
            FROM bc_asset
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return null;
        }
    }

    /**
     * @return null
     */
    public function get_player_asset()
    {
        $player = $_SESSION['ply_id'];
        $query = "
            SELECT
              ast_id,
              ast_asset,
              bc_asset.ast_type,
              ast_atlas,
              bc_asset.ast_level,
              ast_price,
              ast_economic,
              ast_description,
              pas_depreciation
            FROM bc_player_asset

            INNER JOIN bc_asset
              ON ast_id = pas_asset

            INNER JOIN
              (
                SELECT
                  ast_type,
                  MAX(ast_level) as ast_level
                  FROM bc_player_asset

                INNER JOIN bc_asset
                  ON pas_asset = ast_id

                WHERE pas_player = $player
                GROUP BY ast_type
              ) asset_max
              ON bc_asset.ast_type = asset_max.ast_type
              AND bc_asset.ast_level = asset_max.ast_level

            WHERE pas_player = $player
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return null;
        }
    }

    /**
     * @param $asset
     * @return bool
     */
    public function upgrade_asset($asset)
    {
        $data = array(
            "pas_player" => $_SESSION['ply_id'],
            "pas_asset" => $asset
        );
        return $this->Create(Utility::TABLE_PLAYER_ASSET, $data);
    }

    /**
     * @return bool
     */
    public function repair_asset()
    {
        $data = array(
            "pas_depreciation" => 0
        );
        $condition = array(
            "pas_player" => $_SESSION['ply_id']
        );
        return $this->Update(Utility::TABLE_PLAYER_ASSET, $data, $condition);
    }
} 