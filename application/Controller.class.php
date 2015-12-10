<?php
	/**
	 * Created by Vanilla Developer.
	 * User: Angga Ari Wijaya
	 * Date: 11/15/13
	 * Time: 1:40 PM
	 * To change this template use File | Settings | File Templates.
	 */
	 
    abstract class Controller {

        /*
         * @registry object
         */
        protected $framework;

        function __construct($registry) {
            $this->framework = $registry;
        }

        /**
         * @all controllers must contain an index method
         */
        abstract function index();

    }