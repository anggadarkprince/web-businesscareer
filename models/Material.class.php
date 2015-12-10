<?php
/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 */

class Material extends Model{

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
            self::$instance = new Material();
        }
        return self::$instance;
    }

    /**
     * @return null
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
            return null;
        }
    }

    /**
     * @return null
     */
    public function get_player_material()
    {
        $player = $_SESSION['ply_id'];
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
            return null;
        }
    }

    /**
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
     * @param $id
     * @param $stock
     * @param $expired
     * @return bool
     */
    public function update_material($id, $stock, $expired)
    {
        $data = array(
            "pma_stock" => $stock,
            "pma_expired_remaining" => $expired
        );
        $condition = array(
            "pma_id" => $id,
            "pma_player" => $_SESSION['ply_id']
        );
        return $this->Update(Utility::TABLE_PLAYER_MATERIAL, $data, $condition);
    }

    /**
     * @param $material
     * @return bool
     */
    public function remove_material($material)
    {
        $condition = array(
            "pma_id" => $material,
            "pma_player" => $_SESSION['ply_id']
        );
        return $this->Delete(Utility::TABLE_PLAYER_MATERIAL, $condition);
    }
} 