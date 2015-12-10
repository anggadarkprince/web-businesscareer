<?php
	/**
	 * Created by Vanilla Developer.
	 * User: Angga Ari Wijaya
	 * Date: 11/15/13
	 * Time: 1:40 PM
	 * To change this template use File | Settings | File Templates.
	 */
	 
    class Registry {

		/*
		* @the vars array
		* @access private
		*/
		private $vars = array();


		/**
		*
		* @set undefined vars
		* @param string $index
		* @param mixed $value
		* @return void
		*
		*/
        public function __set($index, $value)
        {
			$this->vars[$index] = $value;
        }

		/**
		*
		* @get variables
		* @param mixed $index
		* @return mixed
		*
		*/
        public function __get($index)
        {
			return $this->vars[$index];
        }

    }
