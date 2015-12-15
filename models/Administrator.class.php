<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Administrator extends Model
{
    // applied singleton pattern
    private static $instance = NULL;

    // define constanta fro column table object mapping
    const COLUMN_STG_NAME = "stg_name";
    const COLUMN_STG_DESCRIPTION = "stg_description";
    const COLUMN_STG_KEYWORD = "stg_keyword";
    const COLUMN_STG_EMAIL = "stg_email";
    const COLUMN_STG_NUMBER = "stg_number";
    const COLUMN_STG_ADDRESS = "stg_address";
    const COLUMN_STG_FACEBOOK = "stg_facebook";
    const COLUMN_STG_TWITTER = "stg_twitter";
    const COLUMN_STG_FAVICON = "stg_favicon";
    const COLUMN_USR_UPDATED_AT = "stg_updated_at";
    const COLUMN_USR_CREATED_AT = "stg_created_at";

    /**
     * default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Administrator();
        }
        return self::$instance;
    }

    /**
     * retrieve all data user admin
     * invoked by: Controller.Dashboard.setting()
     * @return array
     */
    public function retrieve_setting()
    {
        if ($this->Read(Utility::TABLE_SETTING)) {
            return $this->FetchDataRow();
        } else {
            return [];
        }
    }

    /**
     * update web setting, upload favicon and update database.
     * invoked by: Controller.Dashboard.setting_update()
     * @param $data
     * @return bool
     */
    public function update_setting($data)
    {
        /*
         * update favicon is optional, then check if $_FILES is empty or not.
         * upload file with image extension and file size 500kb.
         */
        if (isset($_FILES['website_favicon']['name']) && !empty($_FILES['website_favicon']['name'])) {
            $valid_exts = ['jpeg', 'jpg', 'png', 'gif'];
            $max_file_size = 512 * 1024;

            // check if file is larger than criteria and if error key is exist
            if (!$_FILES['website_favicon']['error'] && $_FILES['website_favicon']['size'] < $max_file_size) {

                // get file extension
                $ext = strtolower(pathinfo($_FILES['website_favicon']['name'], PATHINFO_EXTENSION));

                // check valid file format
                if (in_array($ext, $valid_exts)) {

                    $path = __SITE_PATH . '/assets/images/favicon.' . $ext;

                    // upload favicon and fixed the name to favicon.ext
                    $upload = move_uploaded_file($_FILES['website_favicon']['tmp_name'], $path);
                    if ($upload) {
                        $data[Administrator::COLUMN_STG_FAVICON] = 'favicon.' . $ext;
                    } else {
                        // error move file
                        return false;
                    }
                } else {
                    // error extension validation
                    return false;
                }
            } else {
                // error image dimension
                return false;
            }
        }

        return $this->Update(Utility::TABLE_SETTING, $data);
    }

    /**
     * retrieve max, min, avg statistic of all traffic data
     * invoked by: Controller.Report.index()
     * @return array
     */
    public function retrieve_traffic_report()
    {
        $query = "
            SELECT
              MAX(total) AS max_traffic,
              ROUND(AVG(total)) AS avg_traffic,
              MIN(total) AS min_traffic
            FROM
            (
              SELECT
                COUNT(lgg_id) AS total,
                DATE(lgg_created_at) AS date
              FROM bc_log
              GROUP BY date
            ) traffic
        ";

        if ($this->ManualQuery($query)) {
            return $this->FetchDataRow();
        } else {
            return [];
        }
    }

    /**
     * retrieve statistic number of player which played the game for chart
     * invoked by: Controller.Report.index()
     * @return array
     */
    public function retrieve_traffic_chart_data()
    {
        $query = "
            SELECT
              COUNT(lgg_id) as total,
              DATE_FORMAT(lgg_created_at, '%M') AS month
            FROM bc_log
            WHERE lgg_module = 'MODULE_GAME_START'
            GROUP BY month
            ORDER BY lgg_created_at
            LIMIT 12
        ";

        if ($this->ManualQuery($query)) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

}