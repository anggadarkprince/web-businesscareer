<?php
	/**
	 * Created by Vanilla Developer.
	 * User: Angga Ari Wijaya
	 * Date: 11/15/13
	 * Time: 11:07 AM
	 * To change this template use File | Settings | File Templates.
	 */
	 
	class Urlvars {

		public function __construct(){}

		public function url_part($segment){
			if(isset($_GET['magniva'])){
				$parts = explode('/', $_GET['magniva']);
				$part = $parts[$segment-1];;
			}
			else{
				$part = null;
			}
			return $part;
		}

		/**
		 * @get base url
		 * @return string
		 */
		public static function get_base_url(){
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https' ? 'https://' : 'http://';

			$path = $_SERVER['PHP_SELF'];

			$path_parts = pathinfo($path);
			$directory = $path_parts['dirname'];

			$directory = ($directory == "/") ? "" : $directory;

			/**
			 * @return
			 * localhost
			 * or mysite.com
			 */
			$host = $_SERVER['HTTP_HOST'];

			/**
			 * @return
			 * http://localhost/mysite
			 * or http://mysite.com
			 */
			return $protocol.$host.$directory;
		}

	}