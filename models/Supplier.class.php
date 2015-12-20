<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Supplier extends Model
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
     * @return null|object|Supplier
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Supplier();
        }
        return self::$instance;
    }

    /**
     * retrieve master supplier data.
     * invoked by: Controller.GameServer.load_data()
     * @return array
     */
    public function get_supplier_data()
    {
        $query = "
            SELECT
              spl_id,
              spl_type,
              spl_name,
              spl_atlas,
              spl_marker_atlas,
              spl_marker_x,
              spl_marker_y,
              GROUP_CONCAT(DISTINCT sma_material ORDER BY sma_material) AS item
            FROM bc_supplier

            INNER JOIN bc_supplier_material
              ON spl_id = sma_supplier
            GROUP BY spl_id

            UNION

            SELECT
              spl_id,
              spl_type,
              spl_name,
              spl_atlas,
              spl_marker_atlas,
              spl_marker_x,
              spl_marker_y,
              GROUP_CONCAT(DISTINCT sua_asset ORDER BY sua_asset) AS item
            FROM bc_supplier

            INNER JOIN bc_supplier_asset
              ON spl_id = sua_supplier
            GROUP BY spl_id
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

}