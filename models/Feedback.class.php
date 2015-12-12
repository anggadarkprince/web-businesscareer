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

    // define column if feedback table
    const COLUMN_FDB_ID = "fdb_id";
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
     * get singleton instance.
     * role: visitor|player|administrator
     * @return Feedback|null|object
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Feedback();
        }
        return self::$instance;
    }

    /**
     * retrieve feedback by feedback type {standard|important|deleted}.
     * role: administrator
     * invoked by: Controller.feedback.get_data_feedback_standard()
     *             Controller.feedback.get_data_feedback_important()
     *             Controller.feedback.get_data_feedback_deleted()
     * @param $type
     * @return null
     */
    public function fetch($type)
    {
        $criteria = [Feedback::COLUMN_FDB_STATE => $type];

        if ($this->ReadWhere(Utility::TABLE_FEEDBACK, $criteria)) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

    /**
     * visitor send a feedback from contact menu.
     * role: visitor
     * invoked by: Controller.feedback.send_feedback()
     * @param $data
     * @return bool
     */
    public function send($data)
    {
        return $this->Create(Utility::TABLE_FEEDBACK, $data);
    }

    /**
     * reply visitor email, respond the their feedback.
     * prepare email object, sender, content, and receiver.
     * role: administrator
     * invoked by: Controller.feedback.reply_feedback()
     * @param $name
     * @param $email
     * @param $subject
     * @param $message
     * @return bool
     */
    public function reply($name, $email, $subject, $message)
    {
        include_once __SITE_PATH . '/library/PHPMailer/PHPMailerAutoload.php';

        // get separated .ini configuration from stealing my email and password which used to sent email
        $setting = parse_ini_file(get_base_url().'/setting.ini', true);
        $email_address = $setting['email']['email_address'];
        $email_password = $setting['email']['email_password'];

        // instantiate PHPMailer and setup for configuration
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $email_address;
        $mail->Password = $email_password;
        $mail->SMTPSecure = 'tls';
        $mail->From = 'no-reply@seriousgame.com';
        $mail->FromName = 'SeriousGame.Inc';
        $mail->addAddress($email, $name);
        $mail->addReplyTo('no-reply@seriousgame.com', 'SeriousGame.Inc');
        $mail->isHTML(true);

        // build email content
        $mail->Subject = 'Feedback ' . $subject;
        $body = $this->format_email('html', $name, $subject, $message);
        $mail->msgHTML($body, __SITE_PATH . 'assets/etc/');

        // send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        } else {
            echo "Message sent!";
            return true;
        }
    }

    /**
     * format email template from assets/etc.
     * replace string into dynamic value depends on data which given by reply() function.
     * role: administrator
     * invoked by: Model.Feedback.reply()
     * @param $format
     * @param $name
     * @param $subject
     * @param $message
     * @return mixed|string
     */
    private function format_email($format, $name, $subject, $message)
    {
        // set root path
        $root = __SITE_PATH . "/assets/etc";

        // grab the template content
        $template = file_get_contents($root . '/reply_template.' . $format);

        // replace the tags
        $template = preg_replace('%NAME%', $name, $template);
        $template = preg_replace('%SUBJECT%', $subject, $template);
        $template = preg_replace('%MESSAGE%', $message, $template);
        $template = preg_replace('%SITEPATH%', get_base_url(), $template);

        return $template;
    }

    /**
     * mark a feedback as {standard|important} each type of state will be show on different page.
     * role: administrator
     * invoked by: Controller.Feedback.mark_important()
     *             Controller.Feedback.remove_important()
     * @param $state
     * @param $id
     * @return bool
     */
    public function toggle_important($state, $id)
    {
        $criteria = [Feedback::COLUMN_FDB_STATE => $state];

        return $this->Update(Utility::TABLE_FEEDBACK, $criteria, array(Feedback::COLUMN_FDB_ID => $id));
    }

    /**
     * delete feedback (soft delete). just update the feedback state.
     * given mark as deleted record
     * role: administrator
     * invoked by: Controller.Feedback.remove_feedback()
     * @param $id
     * @return bool
     */
    public function remove($id)
    {
        $criteria = [Feedback::COLUMN_FDB_STATE => Feedback::DELETED];

        return $this->Update(Utility::TABLE_FEEDBACK, $criteria, array(Feedback::COLUMN_FDB_ID => $id));
    }

    /**
     * summarized the all feedback and turn into report table.
     * accumulate feedback total {daily|weekly|monthly|yearly}
     * role: administrator
     * invoked by: Controller.Report.index()
     *             Controller.Report.get_overall()
     * @return Array
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
            return [];
        }
    }

}