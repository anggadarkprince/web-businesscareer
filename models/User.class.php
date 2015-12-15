<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class User extends Model
{
    // applied singleton pattern
    private static $instance = NULL;

    // define ENUM vars
    const ACTIVE = "ACTIVE";
    const SUSPEND = 'SUSPEND';

    // define constanta fro column table object mapping
    const COLUMN_USR_ID = "usr_id";
    const COLUMN_USR_USERNAME = "usr_username";
    const COLUMN_USR_PASSWORD = "usr_password";
    const COLUMN_USR_NAME = "usr_name";
    const COLUMN_USR_ABOUT = "usr_about";
    const COLUMN_USR_GENDER = "usr_gender";
    const COLUMN_USR_AVATAR = "usr_avatar";
    const COLUMN_USR_STATE = "usr_state";
    const COLUMN_USR_UPDATED_AT = "usr_updated_at";
    const COLUMN_USR_CREATED_AT = "usr_created_at";

    /**
     * default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null|object|User
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new User();
        }
        return self::$instance;
    }

    /**
     * create new user admin
     * @param $data
     * @return bool
     */
    public function register($data)
    {
        return $this->Create(Utility::TABLE_USER, $data);
    }

    /**
     * retrieve all data user admin
     */
    public function retrieve_all()
    {
        if ($this->Read(Utility::TABLE_USER)) {
            return $this->FetchData();
        }
        return null;
    }

    /**
     * retrieve user admin by id
     */
    public function retrieve_user()
    {
        $data = array(
            User::COLUMN_USR_USERNAME => $_SESSION['web_username']
        );

        if ($this->ReadWhere(Utility::TABLE_USER, $data)) {
            return $this->FetchDataRow();
        }
        return null;
    }

    /**
     * @param $password
     * @return bool
     */
    public function check_authorize_update($password)
    {
        $data = array(
            User::COLUMN_USR_USERNAME => $_SESSION['web_username'],
            User::COLUMN_USR_PASSWORD => $password
        );
        if ($this->ReadWhere(Utility::TABLE_USER, $data)) {
            if ($this->CountRow() > 0) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * @param $data
     * @return bool
     */
    public function update_user($data)
    {
        if (isset($_FILES['profile_avatar']['name']) && !empty($_FILES['profile_avatar']['name'])) {
            $valid_exts = ['jpeg', 'jpg', 'png', 'gif'];
            $max_file_size = 1024 * 1024; #200kb
            $filename = $_SESSION["web_id"] . uniqid();
            if (!$_FILES['profile_avatar']['error'] && $_FILES['profile_avatar']['size'] < $max_file_size) {
                $ext = strtolower(pathinfo($_FILES['profile_avatar']['name'], PATHINFO_EXTENSION));
                if (in_array($ext, $valid_exts)) {

                    $path = __SITE_PATH . '/assets/images/avatar/' . $filename . '.' . $ext;

                    $upload = move_uploaded_file($_FILES['profile_avatar']['tmp_name'], $path);
                    if ($upload) {
                        $data[User::COLUMN_USR_AVATAR] = $filename . '.' . $ext;
                        $_SESSION["web_avatar"] = $filename . '.' . $ext;
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
        return $this->Update(Utility::TABLE_USER, $data, array(User::COLUMN_USR_USERNAME => $_SESSION['web_username']));
    }


    /**
     * @return bool
     * suspend user, we never delete database record for business purpose
     */
    public function suspend()
    {
        $data = [User::COLUMN_USR_STATE => User::SUSPEND];

        return $this->Update(Utility::TABLE_USER, $data, array(User::COLUMN_USR_USERNAME => $_SESSION['web_username']));
    }


    /**
     * @return bool
     * reactive user, we never delete database record for business purpose
     */
    public function reactive()
    {
        $data = [User::COLUMN_USR_STATE => User::ACTIVE];

        return $this->Update(Utility::TABLE_USER, $data, array(User::COLUMN_USR_USERNAME => $_SESSION['web_username']));
    }

}


