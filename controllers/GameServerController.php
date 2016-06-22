<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 */
class GameServerController extends Controller
{
    private $model_product;
    private $model_material;
    private $model_asset;
    private $model_supplier;
    private $model_employee;
    private $model_achievement;
    private $model_journal;
    private $model_player;
    private $model_memorycard;
    private $model_leaderboard;

    /**
     * check login session when enter the game.
     * retrieve player who play the game.
     * role: player
     */
    public function index()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['gameaccess']) && $_POST['gameaccess'] == "businesscareer") {
                $model_player = Player::getInstance();
                $model_memorycard = Memorycard::getInstance();

                /*
                 * check session existence.
                 * check what is the game played for the first time.
                 * wrap up, encode player data and binding the information.
                 */
                $player = $model_player->player_detail($_SESSION['ply_id']);
                $is_first_play = $model_memorycard->check_game_data();

                $binding = array
                (
                    "result_var" => "ready_session",
                    "player_var" => json_encode($player, JSON_PRETTY_PRINT),
                    "game_status" => $is_first_play
                );
                binding_data($binding);
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * populating game data.
     * role: player
     * invoked by: Controller.GameServer.setup_data()
     *             Controller.GameServer.save_data()
     * @return array
     */
    public function collectData()
    {
        $game_data = array(
            "gme_playtime" => $_POST["playtime"],
            "gme_point" => $_POST["point"],
            "gme_cash" => $_POST["cash"],
            "gme_customer" => $_POST["customer"],
            "gme_advisor" => $_POST["advisor"],
            "gme_personal_objective" => $_POST["personalObjective"],
            "gme_business_plan" => $_POST["businessPlan"],
            "gme_financing" => $_POST["financing"],
            "gme_instalment" => $_POST["instalment"],
            "gme_weather" => $_POST["weather"],
            "gme_event" => $_POST["event"],
            "gme_task" => $_POST["tasks"],
            "gme_booster" => $_POST["booster"],
            "gme_avatar_name" => $_POST["avatarName"],
            "gme_avatar_data" => $_POST["avatar"],
            "gme_motivation" => $_POST["motivation"],
            "shp_name" => $_POST["shop"],
            "shp_logo" => $_POST["logo"],
            "shp_district" => $_POST["district"],
            "shp_schedule" => $_POST["schedule"],
            "shp_decoration" => $_POST["decoration"],
            "shp_scent" => $_POST["scent"],
            "shp_cleanness" => $_POST["cleanness"],
            "shp_sales_today" => $_POST["salesToday"],
            "shp_sales_total" => $_POST["salesTotal"],
            "shp_research_data" => $_POST["research"],
            "shp_program_data" => $_POST["program"],
            "shp_advertising_data" => $_POST["advertising"],
            "par_population" => $_POST["valuePopulation"],
            "par_weather" => $_POST["valueWeather"],
            "par_event" => $_POST["valueEvent"],
            "par_competitor" => $_POST["valueCompetitor"],
            "par_social" => $_POST["valueVariant"],
            "par_addicted" => $_POST["valueAddicted"],
            "par_buying" => $_POST["valueBuying"],
            "par_emotion" => $_POST["valueEmotion"]
        );

        $data = array(
            "game_data" => $game_data,
            "employee_data" => $_POST["dataEmployee"]
        );

        return $data;
    }

    /**
     * setup first data when game played for the first time.
     * role: player
     * @return string
     */
    public function setup_data()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_memorycard = Memorycard::getInstance();

                /*
                 * populate data with invoking collectData() method.
                 * invoking memory card model to save first data.
                 * log this event and wrap it up the result.
                 */
                $data = $this->collectData();

                $result = $this->model_memorycard->setup_game_data($data["game_data"]);

                $log = Log::getInstance();
                $log->logging_game_setup(json_encode($data));

                if ($result) {
                    $binding = array("result_var" => true);
                    binding_data($binding);
                } else {
                    $binding = array("result_var" => false);
                    binding_data($binding);
                }
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * saving game data.
     * role: player
     * @return string
     */
    public function save_data()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_memorycard = Memorycard::getInstance();

                /*
                 * populate game data via collectData() method.
                 * invoke another method in memory card model to save data.
                 * log this event and wrap it up the result.
                 */
                $data = $this->collectData();

                $result = $this->model_memorycard->save_game_data($data);

                $log = Log::getInstance();
                $log->logging_game_save(json_encode($data));

                if ($result) {
                    $binding = array("result_var" => true);
                    binding_data($binding);
                } else {
                    $binding = array("result_var" => false);
                    binding_data($binding);
                }
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    /**
     * load game data every play game.
     * role: player
     * @return string
     */
    public function load_data()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_product = Product::getInstance();
                $this->model_material = Material::getInstance();
                $this->model_asset = Asset::getInstance();
                $this->model_supplier = Supplier::getInstance();
                $this->model_employee = Employee::getInstance();
                $this->model_achievement = Achievement::getInstance();
                $this->model_journal = Journal::getInstance();
                $this->model_memorycard = Memorycard::getInstance();
                $this->model_leaderboard = Leaderboard::getInstance();

                /*
                 * retrieve data each component.
                 * log this event, wrap it up and convert to json format.
                 */

                $game = $this->model_memorycard->load_game_data();
                $work_history = $this->model_memorycard->get_work_stress_history();
                $total_work = $this->model_memorycard->get_total_work();

                $candidate = $this->model_employee->get_candidate();
                $employee = $this->model_employee->get_player_employee();

                $material = $this->model_material->get_material_data();
                $player_material = $this->model_material->get_player_material();

                $asset = $this->model_asset->get_asset_data();
                $player_asset = $this->model_asset->get_player_asset();

                $product = $this->model_product->get_product_data();
                $player_product = $this->model_product->get_player_product();
                $product_material = $this->model_product->get_product_material();

                $supplier = $this->model_supplier->get_supplier_data();

                $achievement = $this->model_achievement->get_achievement();

                $account = $this->model_journal->get_account();

                $simulation = $this->model_memorycard->get_simulation();

                $star = $this->model_leaderboard->get_player_ranking();

                $binding = array
                (
                    "result_var" => "session_ready",
                    "game_var" => json_encode($game, JSON_PRETTY_PRINT),
                    "candidate_var" => json_encode($candidate, JSON_PRETTY_PRINT),
                    "employee_var" => json_encode($employee, JSON_PRETTY_PRINT),
                    "product_var" => json_encode($product, JSON_PRETTY_PRINT),
                    "player_product_var" => json_encode($player_product, JSON_PRETTY_PRINT),
                    "product_material_var" => json_encode($product_material, JSON_PRETTY_PRINT),
                    "material_var" => json_encode($material, JSON_PRETTY_PRINT),
                    "player_material_var" => json_encode($player_material, JSON_PRETTY_PRINT),
                    "asset_var" => json_encode($asset, JSON_PRETTY_PRINT),
                    "player_asset_var" => json_encode($player_asset, JSON_PRETTY_PRINT),
                    "supplier_var" => json_encode($supplier, JSON_PRETTY_PRINT),
                    "achievement_var" => json_encode($achievement, JSON_PRETTY_PRINT),
                    "account_var" => json_encode($account, JSON_PRETTY_PRINT),
                    "simulation_var" => json_encode($simulation, JSON_PRETTY_PRINT),
                    "work_history_var" => json_encode($work_history, JSON_PRETTY_PRINT),
                    "work_total_var" => $total_work,
                    "star" => $star["star"]
                );

                $log = Log::getInstance();
                $log->logging_game_load(json_encode($binding));

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
     * @return string
     */
    public function reset_data()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_memorycard = Memorycard::getInstance();
                $result = $this->model_memorycard->reset_game_data($_SESSION['ply_id']);

                if ($result) {
                    $binding = array("result_var" => true);
                    binding_data($binding);
                } else {
                    $binding = array("result_var" => false);
                    binding_data($binding);
                }
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
     * @return string
     */
    public function insert_simulation()
    {
        if (Authenticate::is_player()) {
            if (isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_memorycard = Memorycard::getInstance();

                $day = $_POST['day'];
                $served = $_POST['served'];
                $loss = $_POST['loss'];
                $stress = $_POST['stress'];
                $work = $_POST['work'];
                $location = $_POST['location'];
                $popularity = $_POST['popularity'];
                $overview = $_POST['overview'];

                $result = $this->model_memorycard->insert_simulation($day, $served, $loss, $stress, $work, $location, $popularity, $overview);

                $this->model_asset = Asset::getInstance();
                $this->model_asset->increase_depreciation();
                
                $log = Log::getInstance();
                $log->logging_game_simulation(json_encode(array($day, $served, $loss, $stress, $work, $location, $popularity, $overview)));

                $binding = array(
                    "result_var" => "session_ready",
                    "simulation_var" => $result
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
     * retrieve another avatar from another user.
     * role: player
     * @return string
     */
    public function get_simulation_avatar()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_player = Player::getInstance();

                /*
                 * retrieve at least 3 avatar except player.
                 * wrap it up and convert to json format.
                 */
                $avatar = $this->model_player->fetch_simulation_avatar();

                $binding = array(
                    "result_var" => "session_ready",
                    "avatar_var" => json_encode($avatar, JSON_PRETTY_PRINT)
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