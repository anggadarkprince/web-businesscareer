
    <?php
        if(isset($section)){
            switch($section){
                case pageController::HOME:
                    $this->framework->view->show('/frontend/elements/index_home');
                    break;
                case pageController::REGISTERED:
                    $this->framework->view->show('/frontend/elements/index_registered');
                    break;
                case pageController::CONFIRM:
                    $this->framework->view->show('/frontend/elements/index_confirm');
                    break;
                case pageController::SIGN:
                    $this->framework->view->show('/frontend/elements/index_sign');
                    break;
            }
        }
    ?>


