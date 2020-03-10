<?php

if (!defined('snowboards')) header('Location: /');

class Product_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function getProductInfo($arg) {
		$data = $this->db->select('SELECT * FROM sb_product WHERE id= :id',
									array(':id' => $arg));
		
		return $data;
	}
	
	function getProductReviews($arg) {
		$data = $this->db->select('SELECT * FROM sb_reviews WHERE product= :id',
									array(':id' => $arg));
		
		return $data;
	}
	
	function getUsersName($id = null) {
		if (isset($id)) {
			$result = $this->db->select('SELECT first_name, sur_name FROM sb_users WHERE id= :id',
															array(':id' => $id));
															
			$result = $result[0]['first_name'] . ' ' . $result[0]['sur_name'];
		} else {
			$result = $this->db->select('SELECT id, first_name, sur_name FROM sb_users');
		}
		
		return $result;
	}
	
	function getManufactureList() {
		$result = $this->db->select('SELECT id, name FROM sb_manufacturers');
		
		echo json_encode($result);
	}
	
	function getProfileTypeList() {
		$result = $this->db->select('SELECT id, name FROM sb_profile_types');
		
		echo json_encode($result);
	}
	
	function getWidthList() {
		$result = $this->db->select('SELECT id, name, min, max FROM sb_width');
		
		echo json_encode($result);
	}
	
	function getAbilityLevelList() {
		$result = $this->db->select('SELECT id, name FROM sb_ability_levels');
		
		echo json_encode($result);
	}
	
	function getGenderList() {
		$result = $this->db->select('SELECT id, name FROM sb_gender');
		
		echo json_encode($result);
	}
	
	function checkProductExists() {
		$count = $this->db->rowCount('SELECT id FROM sb_products WHERE name = :name',
										array(':name' => filter_var($_POST['name'], FILTER_SANITIZE_STRIPPED)));
		
		if ($count > 0) {
			echo "true";
		} else {
			echo "false";
		}
	}
	
	function addProduct() {
		try {
			$form = new Form();

			$form	->post('name')
					->validate('minlength', 5)
					->validate('maxlength', 100)

					->post('manufacture')
					->validate('value')

					->post('profile_type')
					->validate('value')

					->post('size')
					->validate('minlength', 2)
					->validate('maxlength', 3)
					->validate('digits')

					->post('width')
					->validate('value')

					->post('ability_level')
					->validate('value')

					->post('gender')
					->validate('value')

					->post('price')
					->validate('number')

					->set('available', 'true')

					->set('pic', 'true');

			$form	->submit();
			
			$data = $form->fetch();
			
		} catch (Exception $e) {
			$error = explode(',', $e->getMessage());
			
			foreach ($error as &$item) {
				$item = explode(' => ', $item);
				
				$item = array('key' => $item[0], 'value' => $item[1]);
			}
			echo json_encode($error);
			return;
		}

		$this->db->insert('sb_products', $data);
		echo 'true';
	}
	
	function addReview() {
		$data = $this->db->select('SELECT MAX(id) as MaxId FROM sb_reviews WHERE product= :product',
									array(':product' => $_POST['product']));

		if (isset($data[0])) {
			$id = $data[0]['MaxId'];
		} else {
			$id = 0;
		}
		$data = $_POST;
		unset($data['request']);
		$data['id'] = $id+1;
		$data['reviewed_date'] = date('Y-m-d H:i:s');
		$data['text'] = filter_var($data['text'], FILTER_SANITIZE_SPECIAL_CHARS);
		$data['text'] = str_replace("&#10;", '<br />', $data['text']);
		
		if ($data['grade'] == 'null') {
			unset($data['grade']);
		}
		
		$this->db->insert('sb_reviews', $data);
		
		$user = $this->db->select('SELECT first_name, sur_name FROM sb_users WHERE id= :id',
									array(':id' => $data['reviewed_by'])
								);
								
		$data['username'] = $user[0]['first_name'] . ' ' . $user[0]['sur_name'];
		echo json_encode($data);
	}
}
