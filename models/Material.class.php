<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 */
class Material extends Model
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
     * @return null|object|Material
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Material();
        }
        return self::$instance;
    }

    /**
     * retrieve master material from database.
     * invoked by: Controller.GameServer.load_data()
     * @return array
     */
    public function get_material_data()
    {
        $query = "
            SELECT
              mtr_id,
              mtr_item,
              mtr_atlas,
              mtr_price,
              mtr_expired_at,
              mtr_type
            FROM bc_material
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

    /**
     * retrieve player's material from database.
     * invoked by: Controller.GameServer.load_data()
     * @param null $player_id
     * @return array
     */
    public function get_player_material($player_id = null)
    {
        if ($player_id != null) {
            $player = $player_id;
        } else {
            $player = $_SESSION['ply_id'];
        }

        $query = "
            SELECT
              pma_id,
              mtr_id,
              mtr_type,
              mtr_item,
              mtr_atlas,
              mtr_price,
              pma_stock,
              pma_expired_remaining
            FROM bc_player_material

            INNER JOIN bc_material
              ON pma_material = mtr_id

            WHERE pma_player = $player
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

    /**
     * player buy new material, insert stock and save expired date.
     * invoked by: Controller.Inventory.buy_material()
     * @param $material
     * @param $stock
     * @param $expired
     * @return bool
     */
    public function buy_material($material, $stock, $expired)
    {
        $data = array(
            "pma_player" => $_SESSION['ply_id'],
            "pma_material" => $material,
            "pma_stock" => $stock,
            "pma_expired_remaining" => $expired
        );
        return $this->Create(Utility::TABLE_PLAYER_MATERIAL, $data);
    }

    /**
     * player buy material which exist already, update new stock.
     * invoked by: Controller.Inventory.buy_material()
     * @param $id
     * @param $stock
     * @param $expired
     * @return bool
     */
    public function update_material($id, $stock, $expired)
    {
        // populate material data.
        $data = [
            "pma_stock" => $stock,
            "pma_expired_remaining" => $expired
        ];

        // material record criteria according to player record.
        $criteria = [
            "pma_id" => $id,
            "pma_player" => $_SESSION['ply_id']
        ];
        return $this->Update(Utility::TABLE_PLAYER_MATERIAL, $data, $criteria);
    }

    /**
     * expired date has pass or player throw away the material.
     * invoked by: Controller.Inventory.remove_material()
     * @param $material
     * @return bool
     */
    public function remove_material($material)
    {
        $criteria = [
            "pma_id" => $material,
            "pma_player" => $_SESSION['ply_id']
        ];
        return $this->Delete(Utility::TABLE_PLAYER_MATERIAL, $criteria);
    }
}