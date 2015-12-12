<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Player extends Model
{
    // applied singleton pattern
    const ACTIVE = "ACTIVE";
    const SUSPEND = 'SUSPEND';
    const PENDING = 'PENDING';
    const COLUMN_PLY_ID = "ply_id";
    const COLUMN_PLY_KEY = "ply_key";
    const COLUMN_PLY_NAME = "ply_name";
    const COLUMN_PLY_EMAIL = "ply_email";
    const COLUMN_PLY_PASSWORD = "ply_password";
    const COLUMN_PLY_AVATAR = "ply_avatar";
    const COLUMN_PLY_STATE = "ply_state";
    const COLUMN_PLY_READ = "ply_read";
    const COLUMN_PLY_UPDATED_AT = "ply_updated_at";
    const COLUMN_PLY_CREATED_AT = "ply_created_at";

    private static $instance = NULL;

    /**
     * default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return null|object|Player
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Player();
        }
        return self::$instance;
    }

    /**
     * @param $data
     * @return bool
     */
    public function register($data)
    {
        if ($this->send_email($data[Player::COLUMN_PLY_EMAIL], $data[Player::COLUMN_PLY_NAME], $data[Player::COLUMN_PLY_KEY])) {
            $result = $this->Create(Utility::TABLE_PLAYER, $data);
            $retrieve = $this->ReadSingleData(Utility::TABLE_PLAYER, array(Player::COLUMN_PLY_EMAIL => $data[Player::COLUMN_PLY_EMAIL]));

            if ($retrieve) {
                $player = $this->FetchDataRow();

                // create registration log
                //$log = Log::getInstance();
                //$log->logging_web_registration($player[Player::COLUMN_PLY_ID], json_encode($data));
            }

            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @param $name
     * @param $key
     * @return bool
     */
    public function send_email($email, $name, $key)
    {
        include_once __SITE_PATH . '/library/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'anggadarkprince@gmail.com';
        $mail->Password = 'guardianoftime';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->From = 'no-reply@seriousgame.com';
        $mail->FromName = 'SeriousGame.Inc';
        $mail->addAddress($email, $name);
        $mail->addReplyTo('no-reply@seriousgame.com', 'SeriousGame.Inc');
        $mail->WordWrap = 50;
        $mail->isHTML(true);

        $mail->Subject = 'Business Career The Game Registration';
        $body = $this->format_email('html', $email, $name, $key);
        $mail->msgHTML($body, __SITE_PATH . 'assets/etc/');

        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        } else {
            echo "Message sent!";
            return true;
        }
    }

    /**
     * @param $format
     * @param $email
     * @param $name
     * @param $key
     * @return mixed|string
     */
    private function format_email($format, $email, $name, $key)
    {
        //set the root
        $root = __SITE_PATH . "/assets/etc";

        //grab the template content
        $template = file_get_contents($root . '/confirmation_template.' . $format);

        //replace all the tags
        $template = preg_replace('%NAME%', $name, $template);
        $template = preg_replace('%EMAIL%', $email, $template);
        $template = preg_replace('%KEY%', $key, $template);
        $template = preg_replace('%SUBJECT%', "Business Career The Game Registration", $template);
        $template = preg_replace('%SITEPATH%', "http://localhost/businesscareer", $template);

        //return the html of the template
        return $template;
    }

    /**
     * @param $name
     * @param $email
     * @return string
     */
    public function generate_key($name, $email)
    {
        $key = $name . $email . uniqid();
        return md5($key);
    }

    /**
     * @param $email
     * @return bool
     */
    public function check_email($email)
    {
        $state = array(
            player::COLUMN_PLY_EMAIL => $email
        );
        $query = $this->ReadWhere(Utility::TABLE_PLAYER, $state);
        if ($query && $this->CountRow() == 1) {
            return true;
        }
        return false;
    }

    /**
     * invoked by: Controller.Player.confirm()
     * @param $email
     * @param $key
     * @return bool
     */
    public function confirm($email, $key)
    {
        $data = array(
            player::COLUMN_PLY_STATE => player::ACTIVE
        );
        if ($this->Update(Utility::TABLE_PLAYER, $data, array(player::COLUMN_PLY_KEY => $key))) {
            $state = array(
                player::COLUMN_PLY_EMAIL => $email,
                player::COLUMN_PLY_KEY => $key
            );
            $query = $this->ReadWhere(Utility::TABLE_PLAYER, $state);
            if ($query && $this->CountRow() == 1) {
                $result = $this->ReadSingleData(Utility::TABLE_PLAYER, array(Player::COLUMN_PLY_EMAIL => $email));

                if ($result) {
                    $player = $this->FetchDataRow();

                    // create confirm log
                    //$log = Log::getInstance();
                    //$log->logging_web_confirm($player[Player::COLUMN_PLY_ID], json_encode($data));
                }

                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * invoked by: Controller.Player.suspend()
     * @param $id
     * @return bool
     */
    public function suspend($id)
    {
        $data = array(
            player::COLUMN_PLY_STATE => player::SUSPEND
        );
        if ($this->Update(Utility::TABLE_PLAYER, $data, array(player::COLUMN_PLY_ID => $id))) {
            return true;
        }
        return false;
    }

    /**
     * invoked by: Controller.Player.reactive()
     * @param $id
     * @return bool
     */
    public function reactive($id)
    {
        $data = array(
            player::COLUMN_PLY_STATE => player::ACTIVE
        );
        if ($this->Update(Utility::TABLE_PLAYER, $data, array(player::COLUMN_PLY_ID => $id))) {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public function fetch_simulation_avatar()
    {
        $all_avatar = $this->fetch();
        $player_avatar = $this->fetch($_SESSION['ply_id'])["ply_avatar"];

        $competitor1_avatar = "";
        $competitor2_avatar = "";

        $competitor1_found = false;
        $competitor2_found = false;
        if (count($all_avatar) >= 3) {
            while (true) {
                $index = rand(0, count($all_avatar) - 1);
                if (!$competitor1_found && $all_avatar[$index]["ply_avatar"] != $player_avatar) {
                    $competitor1_avatar = $all_avatar[$index]["ply_avatar"];
                    $competitor1_found = true;
                }

                if ($competitor1_found && !$competitor2_found && $all_avatar[$index]["ply_avatar"] != $player_avatar && $all_avatar[$index]["ply_avatar"] != $competitor1_avatar) {
                    $competitor2_avatar = $all_avatar[$index]["ply_avatar"];
                    $competitor2_found = true;
                }

                if ($competitor1_found && $competitor2_found) {
                    break;
                }
            }
        } else {
            $competitor1_avatar = "noimage.jpg";
            $competitor2_avatar = "noimage.jpg";
        }
        return array("player" => $player_avatar, "competitor1" => $competitor1_avatar, "competitor2" => $competitor2_avatar);
    }

    /**
     * invoked by: Controller.Player.index()
     *             Controller.Player.detail()
     * @param null $id
     * @return null
     */
    public function fetch($id = null)
    {
        if ($id == null) {
            $condition = "";
        } else {
            $condition = "WHERE ply_id = $id";
        }

        $query = "
            SELECT
              ply_id,
              ply_avatar,
              ply_name,
              ply_email,
              IFNULL(star,1) as ply_star,
              IFNULL(gme_cash,0) as ply_cash,
              ply_state

            FROM bc_player

            LEFT JOIN
            (
              SELECT
                pac_player,
                CEILING(COUNT(pac_player)/2) AS star
              FROM
              (
                SELECT
                  IFNULL(pac_player,gme_player) as pac_player
                  FROM bc_game_data LEFT JOIN bc_player_achievement
                  ON gme_player = pac_player
                  GROUP BY pac_achievement,gme_player
                  ORDER BY pac_player
              ) player_achievement

              GROUP BY pac_player
            ) star
              ON ply_id = pac_player

            LEFT JOIN bc_game_data
              ON ply_id = gme_player

            $condition
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            if ($id == null) {
                return $this->FetchData();
            } else {
                return $this->FetchDataRow();
            }
        } else {
            return null;
        }
    }

    /**
     * @param $state
     * @param $id
     * @return bool
     */
    public function update_state($state, $id)
    {
        $data = array(
            player::COLUMN_PLY_STATE => $state
        );
        return $this->Update(Utility::TABLE_PLAYER, $data, array(player::COLUMN_PLY_ID => $id));
    }

    /**
     * invoked by: Controller.Player.update_profile()
     * @param $data
     * @return bool
     */
    public function update_profile($data)
    {
        // create update profile log
        $log = Log::getInstance();
        $log->logging_web_profile(json_encode($data));
        return $this->Update(Utility::TABLE_PLAYER, $data, array(player::COLUMN_PLY_ID => $_SESSION["ply_id"]));
    }

    /**
     * @return bool
     */
    public function update_avatar()
    {
        $valid_exts = array('jpeg', 'jpg', 'png', 'gif');
        $max_file_size = 500 * 1024; #200kb
        $nw = $nh = 500; # image with # height

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['avatar'])) {
                if (!$_FILES['avatar']['error'] && $_FILES['avatar']['size'] < $max_file_size) {
                    $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
                    if (in_array($ext, $valid_exts)) {
                        $filename = $_SESSION["ply_id"] . uniqid();
                        $path = __SITE_PATH . '/assets/images/avatar/' . $filename . '.' . $ext;
                        $size = getimagesize($_FILES['avatar']['tmp_name']);

                        $x = (int)$_POST['x'];
                        $y = (int)$_POST['y'];
                        $w = (int)$_POST['w'] ? $_POST['w'] : $size[0];
                        $h = (int)$_POST['h'] ? $_POST['h'] : $size[1];

                        $data = file_get_contents($_FILES['avatar']['tmp_name']);
                        $vImg = imagecreatefromstring($data);
                        $dstImg = imagecreatetruecolor($nw, $nh);
                        imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
                        imagejpeg($dstImg, $path);
                        imagedestroy($dstImg);

                        $result = $this->Update(
                            Utility::TABLE_PLAYER,
                            array(
                                player::COLUMN_PLY_AVATAR => $filename . "." . $ext
                            ),
                            array(
                                player::COLUMN_PLY_ID => $_SESSION["play_id"]
                            )
                        );

                        if ($result) {
                            // create update profile log
                            $log = Log::getInstance();
                            $log->logging_web_profile(json_encode($data));

                            $_SESSION["ply_avatar"] = $filename . "." . $ext;
                            return true;
                        } else {
                            echo 'update database failed';
                            return false;
                        }

                    } else {
                        echo 'unknown problem!';
                        return false;
                    }
                } else {
                    echo 'file is too small or large';
                    return false;
                }
            } else {
                echo 'file not set';
                return false;
            }
        } else {
            echo 'bad request!';
            return false;
        }
    }


    /**
     * invoked by: Controller.Player.detail()
     * @param $id
     * @return null
     */
    public function player_detail($id)
    {
        $result = $this->ReadSingleData(Utility::TABLE_PLAYER, array(player::COLUMN_PLY_ID => $id));
        if ($result && $this->CountRow() == 1) {
            return $this->FetchDataRow();
        } else {
            return null;
        }
    }


    /**
     * @return null
     */
    public function registration_statistic()
    {
        $query = "SELECT
                    date(" . player::COLUMN_PLY_CREATED_AT . ") as date,
                    COUNT(" . player::COLUMN_PLY_ID . ") as total

                    FROM
                        " . Utility::TABLE_PLAYER . "

                        GROUP BY date(" . player::COLUMN_PLY_CREATED_AT . ")

                        LIMIT 10";

        if ($this->ManualQuery($query)) {
            return $this->FetchData();
        } else {
            return null;
        }
    }


    /**
     * store total player
     */
    public function get_total_player()
    {
        $query = "SELECT * FROM " . Utility::TABLE_PLAYER . " WHERE " . player::COLUMN_PLY_STATE . " != '" . authenticate::SUPERUSER . "'";
        $result = $this->ManualQuery($query);
        if ($result) {
            $_SESSION['web_total_player'] = $this->CountRow();
        } else {
            $_SESSION['web_total_player'] = "Reload or Try Again";
        }
    }

    /**
     * store unread new player
     */
    public function unread_new_player()
    {
        $state = array(
            player::COLUMN_PLY_READ => 0
        );
        $result = $this->ReadWhere(Utility::TABLE_PLAYER, $state);
        if ($result) {
            $_SESSION['web_new_player'] = $this->CountRow();
        } else {
            $_SESSION['web_new_player'] = "Reload or Try Again";
        }
    }

    /**
     * update new player has read
     */
    public function read_new_player()
    {
        $this->Update(Utility::TABLE_PLAYER, array(player::COLUMN_PLY_READ => 1), array(player::COLUMN_PLY_READ => 0));
    }

    /**
     * @return null
     */
    public function get_player_report()
    {
        $query = "
            SELECT * FROM
                (
                  SELECT COUNT(*) as total_player
                  FROM bc_player
                ) total_player,
                (
                  SELECT COUNT(*) as player_active
                  FROM bc_player
                  WHERE ply_state = 'ACTIVE'
                ) player_active,
                (
                  SELECT COUNT(*) as player_pending
                  FROM bc_player
                  WHERE ply_state = 'PENDING'
                ) player_pending,
                (
                  SELECT COUNT(*) as player_suspend
                  FROM bc_player
                  WHERE ply_state = 'SUSPEND'
                ) player_suspend
        ";

        if ($this->ManualQuery($query)) {
            return $this->FetchDataRow();
        } else {
            return null;
        }
    }

    public function delete_player($id)
    {
        $criteria = [Player::COLUMN_PLY_ID => $id];

        return $this->Delete(Utility::TABLE_PLAYER, $criteria);
    }

}