<?php

class Error404Controller extends Controller
{

    public function index()
    {
        $this->framework->view->heading = '404 Error Code';
        $this->framework->view->description = 'Sorry, this page unavailable';
        $this->framework->view->targetlink = $this->framework->url->get_base_url();
        $this->framework->view->show('error404');
    }

}
