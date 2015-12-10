<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class feedbackController extends Controller
{

    const MESSAGE_SUCCESS = "Feedback sent successfully";
    const MESSAGE_FAILED = "Feedback failed send, Try again or contact our administrator";

    public function index()
    {
        if (authenticate::is_authorized()) {
            $model_player = Player::getInstance();
            $model_player->total_player();
            $model_player->unread_new_player();

            $this->framework->view->page = "feedback";
            $this->framework->view->content = "/backend/pages/feedback";
            $this->framework->view->show("backend/template");
        } else {
            transport("administrator");
        }
    }

    public function get_data_feedback_standard()
    {
        $model_feedback = new Feedback();
        $data = $model_feedback->fetch(Feedback::STANDARD);
        echo json_encode($data);
    }

    public function get_data_feedback_important()
    {
        $model_feedback = new Feedback();
        $data = $model_feedback->fetch(Feedback::IMPORTANT);
        echo json_encode($data);
    }

    public function get_data_feedback_deleted()
    {
        $model_feedback = new Feedback();
        $data = $model_feedback->fetch(Feedback::DELETED);
        echo json_encode($data);
    }

    public function send_feedback()
    {
        $model_feedback = new Feedback();

        $data = array(
            Feedback::COLUMN_FDB_NAME => $_POST['name'],
            Feedback::COLUMN_FDB_EMAIL => $_POST['email'],
            Feedback::COLUMN_FDB_SUBJECT => $_POST['subject'],
            Feedback::COLUMN_FDB_MESSAGE => $_POST['message'],
            Feedback::COLUMN_FDB_STATE => Feedback::STANDARD
        );

        if ($model_feedback->send($data)) {
            echo feedbackController::MESSAGE_SUCCESS;
        } else {
            echo feedbackController::MESSAGE_FAILED;
        }
    }

    public function mark_important()
    {
        $model_feedback = new Feedback();
        echo $model_feedback->toggle_important(Feedback::IMPORTANT, $_POST["id"]);
    }

    public function remove_important()
    {
        $model_feedback = new Feedback();
        echo $model_feedback->toggle_important(Feedback::STANDARD, $_POST["id"]);
    }

    public function remove_feedback()
    {
        $model_feedback = new Feedback();
        echo $model_feedback->remove(Feedback::DELETED, $_POST["id"]);
    }

    public function reply_feedback()
    {
        $model_feedback = new Feedback();
        echo $model_feedback->reply($_POST["name"], $_POST["email"], $_POST["subject"], $_POST["message"]);
    }

}