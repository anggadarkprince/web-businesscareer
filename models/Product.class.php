<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Product extends Model
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
     * @return null|object|Product
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Product();
        }
        return self::$instance;
    }

    /**
     * initializing product when open game for the first time
     */
    public function initialize_product()
    {
        $product_data = $this->get_product_data();
        foreach ($product_data as $product) {
            $data = array(
                "ppr_player" => $_SESSION['ply_id'],
                "ppr_product" => $product["prd_id"],
                "ppr_price" => $product["prd_price"]
            );
            $this->Create(Utility::TABLE_PLAYER_PRODUCT, $data);
        }
    }


    /**
     * @return null
     */
    public function get_product_data()
    {
        $query = "
            SELECT
              prd_id,
              prd_product,
              prd_price + (1000 - MOD(prd_price,1000)) as prd_price,
              prd_atlas,
              prd_type
            FROM bc_product

            INNER JOIN
              (
                SELECT
                  mpr_product,
                  SUM(mtr_price) AS prd_price
                FROM bc_material_product

                INNER JOIN bc_material
                  ON mpr_material = mtr_id

                GROUP BY mpr_product
              ) product_price
              ON prd_id = mpr_product
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
    public function get_player_product()
    {
        $player = $_SESSION['ply_id'];
        $query = "
            SELECT
              prd_id,
              prd_product,
              ppr_price,
              prd_atlas,
              prd_type
            FROM bc_player_product

            INNER JOIN bc_product
              ON ppr_product = prd_id

            WHERE ppr_player = $player"
        ;

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return null;
        }
    }

    /**
     * @param $product
     * @return bool
     */
    public function update_player_product($product)
    {
        $result = true;

        $this->getInstance()->beginTransaction();
        foreach ($product as $attribute) {
            $data = array(
                "ppr_price" => $attribute["ppr_price"]
            );
            $condition = array(
                "ppr_product" => $attribute["ppr_product"],
                "ppr_player" => $_SESSION['ply_id']
            );
            $result = $this->Update(Utility::TABLE_PLAYER_PRODUCT, $data, $condition);

            if (!$result) {
                $this->getInstance()->rollBack();
            }
        }
        $this->getInstance()->commit();

        return $result;
    }

    /**
     * @return null
     */
    public function get_product_material()
    {
        $query = "
            SELECT
              mpr_product,
              GROUP_CONCAT(DISTINCT mpr_material ORDER BY mpr_material) as material
            FROM bc_material_product
            GROUP BY mpr_product
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return null;
        }
    }

}