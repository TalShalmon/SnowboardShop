<?php

if (!defined('snowboards')) header('Location: /');

class User_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function login() {
		$data = $this->db->select('SELECT id, first_name, sur_name, activated, blocked, is_admin FROM sb_users WHERE user_name = :login AND password = :password',
									array(':login' => strtolower($_POST['username']),
											':password' => Hash::create('sha256', HASH_PASSWORD_KEY, strtolower($_POST['username']), $_POST['password'])
									));
		
		if (isset($data[0])) {
			$data = $data[0];
			// login
			Session::init();
			Session::set('id', $data['id']);
			Session::set('userName', $_POST['username']);
			Session::set('name', $data['first_name'] . ' ' . $data['sur_name']);
			Session::set('activated', $data['activated']);
			Session::set('blocked', $data['blocked']);
			Session::set('admin', $data['is_admin']);
			Session::set('loggedIn', true);
			
			$this->db->update('sb_users', array('last_logged' => date('Y-m-d H:i:s')), "`id` = {$data['id']}");
			
			if (Session::get('blocked') == 'false') {
				if (Session::get('activated') == 'true') {
					$url = $_SERVER["HTTP_REFERER"];
					
					header('Location: ' . $url);
				} else {
					Session::set('loggedIn', false);
					Core::error('error_3');
				}
			} else {
				Session::set('loggedIn', false);
				Core::error('error_2');
			}
		} else {
			Core::error('error_1');
		}
		parent::disconnect();
	}
	
	function checkUserExists() {
		$count = $this->db->rowCount('SELECT id FROM sb_users WHERE user_name = :username',
										array(':username' => strtolower($_POST['username'])));
										
		parent::disconnect();

		if ($count > 0) {
			echo "true";
		} else {
			echo "false";
		}
	}
	
	function getCityList() {
		$result = $this->db->select('SELECT id, name FROM sb_cities');
		parent::disconnect();
		
		echo json_encode($result);
	}
	
	public function signup() {
		$userName = $_POST['user_name'];
		$password = $this->makeTempPassword($userName);
		$name = $_POST['first_name'] . ' ' . $_POST['sur_name'];
		$phone = str_replace("-", "", $_POST['phone']);
		
		try {
			$form = new Form();

			$form	->post('user_name')
					->validate('minlength', 5)
					->validate('maxlength', 100)

					->set('password', $password)

					->post('first_name')
					->validate('minlength', 2)
					->validate('maxlength', 45)
					->validate('hebrew')

					->post('sur_name')
					->validate('minlength', 2)
					->validate('maxlength', 45)
					->validate('hebrew')

					->set('registered_date', date('Y-m-d H:i:s'))

					->set('last_logged')

					->post('city')
					->validate('value')

					->post('address')
					->validate('minlength', 2)
					->validate('maxlength', 45)
					->validate('hebrewaddress')

					->post('phone')
					->validate('minlength', 9)
					->validate('maxlength', 11)
					->validate('phone')
					->replace($phone)

					->set('activated', 'false')

					->set('blocked', 'false')

					->set('is_admin', 'false');

			$form	->submit();
			
			$data = $form->fetch();
			
		} catch (Exception $e) {
			$error = explode(',', $e->getMessage());
			
			foreach ($error as &$item) {
				$item = explode(' => ', $item);
				
				$item = array('key' => $item[0], 'value' => $item[1]);
			}
			echo json_encode($error);
			parent::disconnect();
			
			return;
		}

//		$this->db->insert('sb_users', $data);
		parent::disconnect();
		
		$name = '=?UTF-8?B?'.base64_encode($name).'?=';
		echo $this->makeActivation($name, $userName, $password);
	}
	
	function resetPassword() {
		$userName = $_POST['user_name'];
		$password = $this->makeTempPassword($userName);
		
		try {
			$form = new Form();

			$form	->post('user_name')
					->validate('minlength', 5)
					->validate('maxlength', 100)

					->set('password', $password)

					->set('activated', 'false');

			$form	->submit();
			
			$data = $form->fetch();
			
		} catch (Exception $e) {
			$error = explode(',', $e->getMessage());
			
			foreach ($error as &$item) {
				$item = explode(' => ', $item);
				
				$item = array('key' => $item[0], 'value' => $item[1]);
			}
			echo json_encode($error);
			parent::disconnect();
			return;
		}

		$user = $this->db->select('SELECT id, first_name, sur_name FROM sb_users WHERE user_name = :username',
									array(':username' => $userName)
								);
		
		if (count($user) < 1) {
			parent::disconnect();
			echo 'false';
			return;
		}
		$user = $user[0];
		$id = $user['id'];
		$name = $user['first_name'] . ' ' . $user['sur_name'];
		
		$this->db->update('sb_users', $data, "`id`= {$id}");
		parent::disconnect();

		$name = '=?UTF-8?B?'.base64_encode($name).'?=';
		echo $this->makeActivation($name, $userName, $password);
	}
	
	function makeTempPassword($username) {
		Core::checkReferer();
		
		return Hash::create('sha256', HASH_PASSWORD_KEY, $username, uniqid(rand(), true));
	}
	
	function getUserInfo() {
		$data = $this->db->select('SELECT user_name, first_name, sur_name, city, address, phone FROM sb_users WHERE id = :id',
									array(':id' => Session::get('id'))
								);
		
		parent::disconnect();
		echo json_encode($data);
	}
	
	function update() {
		$id = Session::get('id');
		$userName = Session::get('userName');
		$password = $_POST['password'];
		$verify = $_POST['verify'];
		$phone = str_replace("-", "", $_POST['phone']);
		
		try {
			$form = new Form();

			if ($password != '') {
				$form	->post('password')
						->validate('minlength', 5)
						->validate('maxlength', 20)
						->validate('password_verify', $verify)
						->replace(Hash::create('sha256', HASH_PASSWORD_KEY, $userName, $password))

						->set('activated', 'true');
			}
			$form	->post('first_name')
					->validate('minlength', 2)
					->validate('maxlength', 45)
					->validate('hebrew')

					->post('sur_name')
					->validate('minlength', 2)
					->validate('maxlength', 45)
					->validate('hebrew')

					->post('city')
					->validate('value')

					->post('address')
					->validate('minlength', 2)
					->validate('maxlength', 45)
					->validate('hebrewaddress')

					->post('phone')
					->validate('minlength', 9)
					->validate('maxlength', 11)
					->validate('phone')
					->replace($phone);

			$form	->submit();
			
			$data = $form->fetch();
			
		} catch (Exception $e) {
			$error = explode(',', $e->getMessage());
			
			foreach ($error as &$item) {
				$item = explode(' => ', $item);
				
				$item = array('key' => $item[0], 'value' => $item[1]);
			}
			echo json_encode($error);
			parent::disconnect();
			return;
		}

		$this->db->update('sb_users', $data, "`id`= {$id}");
		parent::disconnect();
		
		if ($password != '') {
			Session::set('activated', 'true');
		}

		echo 'true';
	}
	
	function getUserName() {
		$result = $this->db->select('SELECT first_name, sur_name FROM sb_users WHERE id = :id',
										array(':id' => $_POST['id'])
									);
									
		echo json_encode($result);
	}
	
	function activate() {
		$userName = $_GET['email'];
		$password = $_GET['key'];
		
		$data = $this->db->select('SELECT id FROM sb_users WHERE user_name = :username AND password = :password',
									array(':username' => $userName, ':password' => $password)
								);
		
		if (count($data) < 1) {
			parent::disconnect();
			Core::error('error_404');
			return;
		}
		$data = $data[0];
		$data['username'] = $userName;
		
		return $data;
	}
	
	function changePassword() {
		$id = $_POST['id'];
		$userName = $_POST['username'];
		$password = $_POST['password'];
		$verify = $_POST['verify'];
		
		try {
			$form = new Form();

			if ($password != '') {
				$form	->post('password')
						->validate('minlength', 5)
						->validate('maxlength', 20)
						->validate('password_verify', $verify)
						->replace(Hash::create('sha256', HASH_PASSWORD_KEY, $userName, $password))

						->set('last_logged', date('Y-m-d H:i:s'))
						
						->set('activated', 'true');
				
				$form	->submit();
				
				$data = $form->fetch();
			}
		} catch (Exception $e) {
			$error = explode(',', $e->getMessage());
			
			foreach ($error as &$item) {
				$item = explode(' => ', $item);
				
				$item = array('key' => $item[0], 'value' => $item[1]);
			}
			echo json_encode($error);
			parent::disconnect();
			return;
		}

		$this->db->update('sb_users', $data, "`id`= {$id}");
		
		$data = $this->db->select('SELECT first_name, sur_name, blocked, is_admin FROM sb_users WHERE id = :id',
										array(':id' => $id)
									);
		parent::disconnect();
		$data = $data[0];
		
		Session::init();
		Session::set('id', $id);
		Session::set('userName', $userName);
		Session::set('name', $data['first_name'] . ' ' . $data['sur_name']);
		Session::set('activated', 'true');
		Session::set('blocked', $data['blocked']);
		Session::set('admin', $data['is_admin']);
		Session::set('loggedIn', true);

		echo 'true';
	}
	
	function makeActivation($name, $mail, $password) {
		$link		= BASE_URL . 'user/activate?email=' . urlencode($mail) . '&key=' . $password;
		$to			= $name . '<' . $mail . '>';
		$subject	= 'Snowboards אימות משתמש';
		$subject	= '=?UTF-8?B?'.base64_encode($subject).'?=';
		$message	= '<html dir=rtl><head><title>אימות משמש</title>' .
					'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' .
					'<meta http-equiv="X-UA-Compatible" content="IE=9" />' .
					'<style type="text/css">body{background:#87CEFA;}h2 {color:red; background:#ddd;}a{font-weight:bold; text-decoration: none; color:#FF0000;}a:hover{color:#FF00FF;}</style>' .
					'</head><body>' .
					'סיסמתך אופסה,<br />' .
					'על מנת שתוכל להשתמש באתר יש צורך ' .
					strip_tags('<a href="' . $link . '">ללחוץ כאן</a>', '<a>') .
					' ולהחליף סיסמה<br />' .
					'<h2>SnowBoards ישראל</h2>' .
					'</body></html>';
		$headers	= 'From: SnowBoards<noreaply@snowboards.freehostingcloud.com>' . "\r\n" .
					'Reply-To: noreaply@snowboards.freehostingcloud.com' . "\r\n" .
					'MIME-Version: 1.0' . "\r\n" .
		            'Content-type: text/html; charset=UTF-8' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
		
		if(mail($to, $subject, $message, $headers)) {
			// return "מייל נשלח בהצלחה";
			return 'true';
		}

		//return "שליחת המייל נכשלה";
		return 'false';
	}
}
