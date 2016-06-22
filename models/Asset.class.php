<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 1/7/15
 * Time: 12:27 AM
 */
class Asset extends Model
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
     * @return null|object|Asset
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
     * invoked by: Controller.MemoryCard.setup_game_data()
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
     * invoked by: Controller.GameServer.load_data()
     * @return array
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
            return [];
        }
    }

    /**
     * retrieve player's asset from database
     * invoked by: Controller.GameServer.load_data()
     *             Controller.Inventory.retrieve_inventory()
     *             Controller.Inventory.upgrade_asset()
     * @param null $player_id
     * @return array
     */
    public function get_player_asset($player_id = null)
    {
        if ($player_id != null) {
            $player = $player_id;
        } else {
            $player = $_SESSION['ply_id'];
        }

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
            return [];
        }
    }

    /**
     * upgrade player's asset level
     * invoked by: Controller.Inventory.upgrade_asset()
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
     * increase depreciation
     * invoked by: Controller.GameServer.insert_simulation()
     * @return bool
     */
    public function increase_depreciation()
    {
        $playerId = $_SESSION['ply_id'];
        echo "test". $playerId;

        $query = "
          SELECT 
            ast_id, 
            ast_economic 
            FROM bc_asset 
            
            INNER JOIN bc_player_asset 
              ON ast_id = pas_asset 
              
              WHERE pas_player = $playerId
              ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            $assets = $this->FetchData();
            foreach ($assets as $attribute) {
                $query = "
                  UPDATE bc_player_asset 
                  SET 
                  pas_depreciation = pas_depreciation + ".$attribute["ast_economic"]." 
                  WHERE pas_player = $playerId 
                  AND pas_asset = ".$attribute["ast_id"];
                $result = $this->ManualQuery($query);                
            }
        }
        return $result;
    }

    /**
     * repair player's asset from deprecation
     * invoked by: Controller.Inventory.repair_asset()
     * @return bool
     */
    public function repair_asset()
    {
        $data = ["pas_depreciation" => 0];
        $criteria = ["pas_player" => $_SESSION['ply_id']];
        return $this->Update(Utility::TABLE_PLAYER_ASSET, $data, $criteria);
    }
} 