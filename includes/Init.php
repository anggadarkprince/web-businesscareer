<?php

    /*** include the controllers class ***/
    include __SITE_PATH . '/application/' . 'controller.class.php';

    /*** include the models class ***/
    include __SITE_PATH . '/application/' . 'model.class.php';

    /*** include the registry class ***/
    include __SITE_PATH . '/application/' . 'registry.class.php';

    /*** include the router class ***/
    include __SITE_PATH . '/application/' . 'router.class.php';

    /*** include the template class ***/
    include __SITE_PATH . '/application/' . 'template.class.php';

    /*** include the url class ***/
    include __SITE_PATH . '/application/' . 'urlvars.class.php';
	
	include 'helper.php';

    /*** auto load models classes ***/
    function __autoload($class_name) {
        $filename = strtolower($class_name) . '.class.php';
        $file = __SITE_PATH . '/models/' . $filename;

        if (file_exists($file) == false)
        {
            return false;
        }
        include ($file);

    }

    /*** a new registry object ***/
    $registry = new Registry;