<?php
	/**
	 * Created by Vanilla Developer.
	 * User: Angga Ari Wijaya
	 * Date: 11/15/13
	 * Time: 11:07 AM
	 * To change this template use File | Settings | File Templates.
	 */
	 
    class Router {

		/*
		* @the registry
		*/
		private $registry;

		/*
		* @the controllers path
		*/
		private $path;

		private $args = array();

        private $default_controller = 'page';

		public $file;

		public $controller;

		public $action;


		function __construct($registry) {
			$this->registry = $registry;
		}

        /**
         * @set controllers directory path
         * @param string $path
         * @throws Exception
         */
		function setPath($path) {
			/*** check if path is a directory ***/
			if (!is_dir($path))
			{
				throw new Exception ('Invalid controllers path: `' . $path . '`');
			}
			
			/*** set the path ***/
			$this->path = $path;
		}


		/**
		*
		* @load the controllers
		* @access public
		* @return void
		*
		*/
		public function loader()
		{
            /*** check the route ***/
            $this->getController();

            /*** if the file is not there ***/
            if (!is_readable($this->file))
            {
				$this->file = $this->path.'/error404.php';
				$this->controller = 'error404';
            }

            /*** include the controllers ***/
            include $this->file;

            /*** a new controllers class instance ***/
            $class = $this->controller . 'Controller';
            $controller = new $class($this->registry);

            /*** check if the action is callable ***/
            if (!is_callable(array($controller, $this->action)))
            {
                $action = 'index';
            }
            else
            {
                $action = $this->action;
            }
            /*** run the action ***/
            $controller->$action();
        }


		/**
		*
		* @get the controllers
		* @access private
		* @return void
		*
		*/
        private function getController() {

            /*** get the route from the url ***/
            $route = (empty($_GET['magniva'])) ? '' : $_GET['magniva'];

            /*** get the parts of the route ***/
            $parts = explode('/', $route);
            $folder = '/';
            if (is_dir(__SITE_PATH . '/controllers/'.$parts[0]) && isset($parts[1]))
            {
                $this->controller = $parts[1];
                if(isset($parts[2]))
                {
                    $this->action = $parts[2];
                }
                $folder = '/'.$parts[0].'/';
            }
            else{
                $this->controller = $parts[0];
                if(isset($parts[1]))
                {
                    $this->action = $parts[1];
                }
            }

            /*** Get default action ***/
            if (empty($this->controller))
            {
                $this->controller = $this->default_controller;
            }

            /*** Get action ***/
            if (empty($this->action))
            {
                $this->action = 'index';
            }

            /*** set the file path ***/
            $this->file = $this->path . $folder . $this->controller . 'Controller.php';
        }

    }