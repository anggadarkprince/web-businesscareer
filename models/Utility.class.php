<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/1/14
 * Time: 9:19 PM
 */
class Utility
{
    /**
     * web entity
     */
    const TABLE_USER = 'wb_user';
    const TABLE_SETTING = 'wb_setting';
    const TABLE_FEEDBACK = 'wb_feedback';

    /**
     * game entity
     */
    const TABLE_GAME_DATA = 'bc_game_data';
    const TABLE_PLAYER = 'bc_player';
    const TABLE_LOGGING = 'bc_log';
    const TABLE_ACHIEVEMENT = 'bc_achievement';
    const TABLE_PLAYER_ACHIEVEMENT = 'bc_player_achievement';
    const TABLE_EMPLOYEE = 'bc_employee';
    const TABLE_PLAYER_EMPLOYEE = 'bc_player_employee';
    const TABLE_MATERIAL = 'bc_material';
    const TABLE_PLAYER_MATERIAL = 'bc_player_material';
    const TABLE_ASSET = 'bc_asset';
    const TABLE_PLAYER_ASSET = 'bc_player_asset';
    const TABLE_PRODUCT = 'bc_product';
    const TABLE_PLAYER_PRODUCT = 'bc_player_product';
    const TABLE_JOURNAL = 'bc_journal';
    const TABLE_SIMULATION = 'bc_simulation';

    /**
     * accounting entity
     */
    const TABLE_ACCOUNT = 'bc_account';


    /**
     * utility helper
     * pre params for PDO query builder
     * @param $string
     * @return string
     */
    public static function pre_params($string)
    {
        return ":" . $string;
    }

    /**
     * utility helper
     * get timestamp format for manual sql
     */
    public static function timestamp()
    {
        return date("Y-m-d H:i:s");
    }

    /**
     * utility helper
     * get date format for manual sql
     */
    public static function date()
    {
        return date("Y-m-d");
    }

    /**
     * utility helper
     * hashing data with md5
     * @param $value
     * @return string
     */
    public static function encrypt($value)
    {
        return md5($value);
    }

    /**
     * utility helper
     * generate unique key for some resource
     */
    public static function generate_key()
    {
        return md5(uniqid() . time());
    }

    /**
     * utility helper
     * pretty print for array
     * @param $data
     */
    public static function pretty_print($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    /**
     * @param $num
     * @return float|string
     */
    public static function thousandsCurrencyFormat($num)
    {
        if ($num <= 0) {
            return 0;
        }
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('K', 'M', 'B', 'T');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int)$x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
    }

    public static function format_currency($value, $decimal = 0, $decimal_separator = ",", $thousand_separator = ".")
    {
        return number_format($value, $decimal, $decimal_separator, $thousand_separator);
    }

} 