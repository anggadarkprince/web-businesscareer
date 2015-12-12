
    <?php
        if(isset($section)){
            switch($section){
                case PageController::HOME:
                    $this->framework->view->show('/frontend/elements/index_home');
                    break;
                case PageController::REGISTERED:
                    $this->framework->view->show('/frontend/elements/index_registered');
                    break;
                case PageController::CONFIRM:
                    $this->framework->view->show('/frontend/elements/index_confirm');
                    break;
                case PageController::SIGN:
                    $this->framework->view->show('/frontend/elements/index_sign');
                    break;
            }
        }


