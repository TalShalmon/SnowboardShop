<?php

if (!defined('snowboards')) header('Location: /');

class Model {
	function __construct() {
		$this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
	}
	
	function disconnect() {
		$this->db = null;
	}
}
