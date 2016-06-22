<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 21/06/2016
 * Time: 16.29
 */
class ProductController extends Controller
{
    private $model_product;

    public function index()
    {
        transport("error404");
    }

    /**
     * update product price.
     *
     * role: player
     */
    public function update_product_price()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_product = Product::getInstance();
                $product = $_POST['product_data'];

                $result = $this->model_product->update_player_product($product);

                $binding = array
                (
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