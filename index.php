<?php

    /*** error reporting on ***/
    error_reporting(E_ALL);

    /*** define the site path ***/
    $site_path = realpath(dirname(__FILE__));
    define ('__SITE_PATH', $site_path);

    /*** include the init.php file ***/
    include 'includes/init.php';

    /*** load the router ***/
    $registry->router = new router($registry);

    /*** set the controllers path ***/
    $registry->router->setPath (__SITE_PATH . '/controllers');

    /*** load up the template ***/
    $registry->view = new template($registry);

    /*** load the url helper ***/
    $registry->url = new Urlvars($registry);

    /*** load the controllers ***/
    $registry->router->loader();
