<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Feedback extends Model
{

    // applied singleton pattern
    private static $instance = NULL;

    // define ENUM vars
    const STANDARD = "STANDARD";
    const IMPORTANT = 'IMPORTANT';
    const DELETED = 'DELETED';

    const COLUMN_FDB_ID = "fdb_id";
    const COLUMN_FDB_TIMESTAMP = "fdb_timestamp";
    const COLUMN_FDB_NAME = "fdb_name";
    const COLUMN_FDB_EMAIL = "fdb_email";
    const COLUMN_FDB_SUBJECT = "fdb_subject";
    const COLUMN_FDB_MESSAGE = "fdb_message";
    const COLUMN_FDB_STATE = "fdb_state";


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
            self::$instance = new Feedback();
        }
        return self::$instance;
    }


    /**
     * @param $type
     * @return null
     */
    public function fetch($type)
    {
        $data = array(
            Feedback::COLUMN_FDB_STATE => $type
        );
        if ($this->ReadWhere(Utility::TABLE_FEEDBACK, $data)) {
            return $this->FetchData();
        } else {
            return null;
        }
    }

    /**
     * @param $data
     * @return bool
     */
    public function send($data)
    {
        return $this->Create(Utility::TABLE_FEEDBACK, $data);
    }

    /**
     * @param $name
     * @param $email
     * @param $subject
     * @param $message
     * @return bool
     */
    public function reply($name, $email, $subject, $message)
    {
        include_once __SITE_PATH . '/library/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'anggadarkprince@gmail.com';
        $mail->Password = 'guardianoftime';
        $mail->SMTPSecure = 'tls';

        $mail->From = 'no-reply@seriousgame.com';
        $mail->FromName = 'SeriousGame.Inc';
        $mail->addAddress($email, $name);
        $mail->addReplyTo('no-reply@seriousgame.com', 'SeriousGame.Inc');
        $mail->WordWrap = 50;
        $mail->isHTML(true);

        $mail->Subject = 'Feedback ' . $subject;
        $body = $this->format_email('html', $name, $subject, $message);
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
     * @param $name
     * @param $subject
     * @param $message
     * @return mixed|string
     */
    private function format_email($format, $name, $subject, $message)
    {
        //set the root
        $root = __SITE_PATH . "/assets/etc";

        //grab the template content
        $template = file_get_contents($root . '/reply_template.' . $format);

        //replace all the tags
        $template = preg_replace('%NAME%', $name, $template);
        $template = preg_replace('%SUBJECT%', $subject, $template);
        $template = preg_replace('%MESSAGE%', $message, $template);
        $template = preg_replace('%SITEPATH%', "http://localhost/businesscareer", $template);

        //return the html of the template
        return $template;
    }

    /**
     * @param $state
     * @param $id
     * @return bool
     */
    public function toggle_important($state, $id)
    {
        $data = array(
            Feedback::COLUMN_FDB_STATE => $state
        );
        return $this->Update(Utility::TABLE_FEEDBACK, $data, array(Feedback::COLUMN_FDB_ID => $id));
    }

    /**
     * @param $state
     * @param $id
     * @return bool
     */
    public function remove($state, $id)
    {
        $data = array(
            Feedback::COLUMN_FDB_STATE => $state
        );
        return $this->Update(Utility::TABLE_FEEDBACK, $data, array(Feedback::COLUMN_FDB_ID => $id));
    }

    /**
     * @return null
     */
    public function retrieve_feedback_report()
    {
        $query = "
            SELECT * FROM

            (
              SELECT COUNT(*) AS feedback_today
              FROM wb_feedback
              WHERE DATE(fdb_created_at) = CURDATE()
            ) today,

            (
              SELECT COUNT(*) AS last_week
              FROM wb_feedback
              ORDER BY fdb_created_at DESC LIMIT 7
            ) last_week,

            (
              SELECT COUNT(*) AS last_month
              FROM wb_feedback
              ORDER BY fdb_created_at DESC LIMIT 30
            ) last_month,

            (
              SELECT COUNT(*) AS last_year
              FROM wb_feedback
              ORDER BY fdb_created_at DESC LIMIT 360
            ) last_year,

            (
              SELECT COUNT(*) AS total
              FROM wb_feedback
            ) total
        ";

        if ($this->ManualQuery($query)) {
            return $this->FetchDataRow();
        } else {
            return null;
        }
    }

}