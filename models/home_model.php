<?php

if (!defined('snowboards')) header('Location: /');

class Home_Model extends Model {
	public function __construct() {
		parent::__construct();
	}

	function getProductsList() {
		$result = $this->db->select('SELECT id, name, price FROM sb_products');
		parent::disconnect();
		
		echo json_encode($result);
	}
}
