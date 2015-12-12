<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class Error404Controller extends Controller
{
    /**
     * Show ERROR404 message when route does not meet valid controller or action
     * role: visitor|player|administrator
     */
    public function index()
    {
        $this->framework->view->heading = '404 Error Code';
        $this->framework->view->description = 'Sorry, this page unavailable';
        $this->framework->view->targetlink = $this->framework->url->get_base_url();
        $this->framework->view->show('error404');
    }

}
