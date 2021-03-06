<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 */
class InventoryController extends Controller
{
    private $model_product;
    private $model_material;
    private $model_asset;

    public function index()
    {
        transport("error404");
    }

    /**
     * retrieve inventory data.
     * role: player
     */
    public function retrieve_inventory()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_product = Product::getInstance();
                $this->model_material = Material::getInstance();
                $this->model_asset = Asset::getInstance();

                $product = $this->model_product->get_player_product();
                $material = $this->model_material->get_player_material();
                $asset = $this->model_asset->get_player_asset();

                $binding = array(
                    "result_var" => "session_ready",
                    "product_var" => json_encode($product, JSON_PRETTY_PRINT),
                    "material_var" => json_encode($material, JSON_PRETTY_PRINT),
                    "asset_var" => json_encode($asset, JSON_PRETTY_PRINT)
                );

                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * buy material for product, update stock or add new one.
     * role: player
     */
    public function buy_material()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_material = Material::getInstance();

                if ($_POST['action'] == "new") {
                    $material = $_POST['material'];
                    $stock = $_POST['stock'];
                    $expired = $_POST['expired'];

                    $result = $this->model_material->buy_material($material, $stock, $expired);
                } else {
                    $id = $_POST['id'];
                    $stock = $_POST['stock'];
                    $expired = $_POST['expired'];

                    $result = $this->model_material->update_material($id, $stock, $expired);
                }

                $player_material = $this->model_material->get_player_material();

                $binding = array(
                    "result_var" => "session_ready",
                    "status_var" => $result,
                    "player_material_var" => json_encode($player_material, JSON_PRETTY_PRINT),
                );
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * delete material from inventory.
     * role: player
     */
    public function remove_material()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_material = Material::getInstance();

                $material = $_POST["material_id"];
                $result = $this->model_material->remove_material($material);

                $binding = array(
                    "result_var" => "session_ready",
                    "status_var" => $result
                );

                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * upgrade level of asset and return current asset list.
     * role: player
     */
    public function upgrade_asset()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_asset = Asset::getInstance();

                $asset = $_POST['asset'];

                $result = $this->model_asset->upgrade_asset($asset);

                $player_asset = $this->model_asset->get_player_asset();

                $binding = array(
                    "result_var" => "session_ready",
                    "status_var" => $result,
                    "player_asset_var" => json_encode($player_asset, JSON_PRETTY_PRINT)
                );
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * role: player
     */
    public function repair_asset()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_asset = Asset::getInstance();

                $result = $this->model_asset->repair_asset();

                $binding = array(
                    "result_var" => "session_ready",
                    "status_var" => $result
                );
                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * role: player
     */
    public function update_material()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_material = Material::getInstance();
                $material = $_POST["material_data"];

                $result = true;
                foreach (json_decode($material) as $attribute) {
                    $result = $this->model_material->update_material($attribute->pma_id, $attribute->pma_stock, $attribute->pma_expired_remaining);
                }

                $binding = array(
                    "result_var" => "session_ready",
                    "status_var" => $result
                );

                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }
}