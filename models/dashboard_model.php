<?php

if (!defined('snowboards')) header('Location: /');

class Dashboard_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function ajaxGetListings() {
		$result = $this->db->select('SELECT id, name, price, pic FROM sb_products');
		echo json_encode($result);
	}
	
	public function ajaxInsert() {
		$text = filter_var($_POST['text'], FILTER_SANITIZE_SPECIAL_CHARS);
		
		$this->db->insert('data', array('text' => $text));
		
		$data = array('text' => $text, 'id' => $this->db->lastInsertId());
		echo json_encode($data);
	}
	
	public function ajaxDeleteListing() {
		$id = $_POST['id'];
		$this->db->delete('data', "id = '$id'");
	}
}
