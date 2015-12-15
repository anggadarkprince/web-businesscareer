<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Memorycard extends Model
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
     * @return null|object|Memorycard
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Memorycard();
        }
        return self::$instance;
    }

    /**
     * invoked by: Controller.GameServer.index(()
     * @return string
     */
    public function check_game_data()
    {
        $condition = array(
            "gme_player" => $_SESSION['ply_id']
        );

        $result = $this->ReadWhere(Utility::TABLE_GAME_DATA, $condition);

        if ($result && $this->CountRow() > 0) {
            return "load";
        } else {
            return "setup";
        }
    }

    /**
     * invoked by: Controller.GameServer.setup_data()
     * @param $game_data
     * @return bool
     */
    public function setup_game_data($game_data)
    {
        $game_data["gme_player"] = $_SESSION['ply_id'];
        $this->Create(Utility::TABLE_GAME_DATA, $game_data);

        $product = Product::getInstance();
        $product->initialize_product();

        $asset = Asset::getInstance();
        $asset->initialize_asset();

        //$model_journal = Journal::getInstance();
        //$model_journal->post_transaction($description, 111, $credit, 8000000, 1);

        return true;
    }

    /**
     * invoked by: Controller.GameServer.save_data()
     * @param $data
     * @return bool
     */
    public function save_game_data($data)
    {
        $condition = array(
            "gme_player" => $_SESSION['ply_id']
        );
        $this->Update(Utility::TABLE_GAME_DATA, $data["game_data"], $condition);

        $modal_employee = Employee::getInstance();
        $modal_employee->update_employee_status($data["employee_data"]);

        //$modal_inventory = Inventory::getInstance();
        //$modal_inventory->update_material_status($data["material_data"]);
        //$modal_inventory->update_asset_status($data["asset_data"]);

        return true;
    }

    /**
     * invoked by: Controller.GameServer.load_data()
     * @return null
     */
    public function load_game_data()
    {
        $condition = array(
            "gme_player" => $_SESSION['ply_id']
        );
        $result = $this->ReadWhere(Utility::TABLE_GAME_DATA, $condition);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchDataRow();
        } else {
            return null;
        }
    }

    /**
     * invoked by: Controller.GameServer.reset_data()
     * @param $player
     * @return bool
     */
    public function reset_game_data($player)
    {
        $this->ManualQuery("DELETE from bc_player_asset WHERE pas_player = $player");
        $this->ManualQuery("DELETE from bc_player_employee WHERE pem_player = $player");
        $this->ManualQuery("DELETE from bc_player_material WHERE pma_player = $player");
        $this->ManualQuery("DELETE from bc_game_data WHERE gme_player = $player");
        $this->ManualQuery("DELETE from bc_player_product WHERE ppr_player = $player");
        $this->ManualQuery("DELETE from bc_journal WHERE jrl_player = $player");
        $this->ManualQuery("DELETE from bc_transaction WHERE trn_player = $player");

        return true;
    }

    /**
     * invoked by: Controller.GameServer.load_data()
     * @return array
     */
    public function get_simulation()
    {
        $player = $_SESSION['ply_id'];

        $result = $this->ManualQuery("
            SELECT * FROM bc_simulation
            WHERE sim_player = $player LIMIT 6
        ");

        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

    /**
     * invoked by: Controller.GameServer.insert_simulation()
     * @param $day
     * @param $served
     * @param $loss
     * @param $stress
     * @param $work
     * @param $location
     * @param $popularity
     * @param $overview
     * @return bool
     */
    public function insert_simulation($day, $served, $loss, $stress, $work, $location, $popularity, $overview)
    {
        $data = array(
            "sim_player" => $_SESSION['ply_id'],
            "sim_day" => $day,
            "sim_served" => $served,
            "sim_loss" => $loss,
            "sim_stress" => $stress,
            "sim_work_hour" => $work,
            "sim_location" => $location,
            "sim_popularity" => $popularity,
            "sim_overview" => $overview
        );
        return $this->Create(Utility::TABLE_SIMULATION, $data);
    }

    /**
     * invoked by: Controller.GameServer.load_data()
     * @return null
     */
    public function get_work_stress_history()
    {
        $player = $_SESSION['ply_id'];
        $query = "
            SELECT
              sim_stress,
              sim_work_hour
            FROM bc_simulation

            WHERE sim_player = $player
            ORDER BY sim_day LIMIT 6
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return null;
        }
    }

    /**
     * invoked by: Controller.GameServer.load_data()
     * @return null|string
     */
    public function get_total_work()
    {
        $player = $_SESSION['ply_id'];
        $query = "
            SELECT
              SUM(sim_work_hour) AS work
            FROM bc_simulation

            WHERE sim_player = $player
        ";

        $result = $this->ManualQuery($query);
        if ($result) {
            $data = $this->FetchDataRow();
            if (!empty($data["work"])) {
                return $data["work"];
            } else {
                return "0";
            }
        } else {
            return null;
        }
    }

}