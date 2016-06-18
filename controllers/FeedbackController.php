<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 */
class FeedbackController extends Controller
{
    const MESSAGE_SUCCESS = "Feedback sent successfully";
    const MESSAGE_FAILED = "Feedback failed to send, Try again or contact our administrator";

    /**
     * show feedback management page on administrator feature.
     * role: administrator
     */
    public function index()
    {
        if (Authenticate::is_authorized()) {
            $model_player = Player::getInstance();
            $model_player->get_total_player();
            $model_player->unread_new_player();

            $this->framework->view->page = "feedback";
            $this->framework->view->content = "/backend/pages/feedback";
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

    /**
     * AJAX feedback standard response.
     * return json of feedback with STANDARD state.
     * role: administrator
     */
    public function get_data_feedback_standard()
    {
        $model_feedback = new Feedback();
        $data = $model_feedback->fetch(Feedback::STANDARD);
        echo json_encode($data);
    }

    /**
     * AJAX feedback which marked as important.
     * return json of feedback with IMPORTANT state.
     * role: administrator
     */
    public function get_data_feedback_important()
    {
        $model_feedback = new Feedback();
        $data = $model_feedback->fetch(Feedback::IMPORTANT);
        echo json_encode($data);
    }

    /**
     * AJAX response which marked as deleted record.
     * return json of feedback with DELETED state.
     * role: administrator
     */
    public function get_data_feedback_deleted()
    {
        $model_feedback = new Feedback();
        $data = $model_feedback->fetch(Feedback::DELETED);
        echo json_encode($data);
    }

    /**
     * send feedback via AJAX from contact page in frontend.
     * return string of status message.
     * role: visitor
     */
    public function send_feedback()
    {
        $model_feedback = new Feedback();

        $data = [
            Feedback::COLUMN_FDB_NAME       => $_POST['name'],
            Feedback::COLUMN_FDB_EMAIL      => $_POST['email'],
            Feedback::COLUMN_FDB_SUBJECT    => $_POST['subject'],
            Feedback::COLUMN_FDB_MESSAGE    => $_POST['message'],
            Feedback::COLUMN_FDB_STATE      => Feedback::STANDARD
        ];

        if ($model_feedback->send($data)) {
            echo FeedbackController::MESSAGE_SUCCESS;
        } else {
            echo FeedbackController::MESSAGE_FAILED;
        }
    }

    /**
     * request to mark feedback as important via ajax and return query status {true/false}.
     * role: administrator
     */
    public function mark_important()
    {
        $model_feedback = new Feedback();

        echo $model_feedback->toggle_important(Feedback::IMPORTANT, $_POST["id"]);
    }

    /**
     * request to REMOVE mark feedback as important via ajax and return query status {true/false}.
     * role: administrator
     */
    public function remove_important()
    {
        $model_feedback = new Feedback();

        echo $model_feedback->toggle_important(Feedback::STANDARD, $_POST["id"]);
    }

    /**
     * request mark feedback as DELETED record via ajax and return query status {true/false}
     * role: administrator
     */
    public function remove_feedback()
    {
        $model_feedback = new Feedback();

        echo $model_feedback->remove($_POST["id"]);
    }

    /**
     * reply feedback to visitor email
     * role: administrator
     */
    public function reply_feedback()
    {
        $model_feedback = new Feedback();

        echo $model_feedback->reply($_POST["name"], $_POST["email"], $_POST["subject"], $_POST["message"]);
    }

}