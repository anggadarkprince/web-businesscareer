<?php
	/**
	 * Created by Vanilla Developer.
	 * User: Angga Ari Wijaya
	 * Date: 11/15/13
	 * Time: 1:40 PM
	 * To change this template use File | Settings | File Templates.
	 */

	/*** include the database class ***/
	include __SITE_PATH . '/application/' . 'database.class.php';

	class Model extends database{

		function __construct() {
			Database::getInstance();
		}
	}