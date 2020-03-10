<?php

if (!defined('snowboards')) header('Location: /');

class User extends Controller {
	public function __construct() {
		parent::__construct();
	}
	
	function login() {
		Core::checkReferer();
		
		$this->model->login();
	}
	
	function logout() {
		Core::checkReferer();

		Session::destroy();
	}
	
	function register() {
		if (Session::get('loggedIn')) {
			$url = $_SERVER["HTTP_REFERER"];
			
			header('Location: ' . $url);
			die;
		}
		
		$this->view->title = 'רישום משתמש חדש';
		$this->view->css = array('form.css');
		$this->view->js = array('register.js');
		$this->view->loginHide = true;

		$this->view->render('register');
	}
	
	function checkUserExists() {
		if(!isset($_POST['request']) || $_POST['request'] != 'ajax') {
			Core::error('error_404');
			die;
		}
				
		$this->view->userExist = $this->model->checkUserExists();
	}
	
	function getCityList() {
		Core::checkReferer();
		
		$this->view->cityList = $this->model->getCityList();
	}
	
	function signup() {
		Core::checkReferer();
		
		$this->model->signup();
	}
	
	function forgotPassword() {
		if (Session::get('loggedIn') == 'true') {
			header('Location: ' . URL);
		}
		$this->view->css = array('form.css');
		$this->view->js = array('activation.js');
		$this->view->title = 'איפוס סיסמה';
		$this->view->loginHide = true;

		$this->view->render('forgotPassword');
	}
	
	function resetPassword() {
		Core::checkReferer();
		
		$this->model->resetPassword();
	}
	
	function details() {
		if ((Session::get('loggedIn')) == false) {
			header('Location: ' . URL);
			return;
		}

		$this->view->title = 'פרטי משתמש - ';
		$this->view->css = array('form.css');
		$this->view->js = array('user.js');

		$this->view->render('details');
	}
	
	function getUserInfo() {
		Core::checkReferer();
		
		$this->model->getUserInfo();
	}
	
	function update() {
		Core::checkReferer();
		
		$this->model->update();
	}
	
	function getUserName() {
		Core::checkReferer();
		
		$this->model->getUserName();
	}
	
	function activate() {
		if (!isset($_GET['email']) || !isset($_GET['key']) || strlen($_GET['key']) != 64) {
			Core::error('error_404');
			return;
		}

		$user = $this->model->activate();
		
		$this->view->title = 'שינוי סיסמה';
		$this->view->css = array('form.css');
		$this->view->js = array('activation.js');
		$this->view->loginHide = true;
		$this->view->user = $user;

		$this->view->render('changePassword');
		
	}
	
	function changePassword() {
		Core::checkReferer();
		
		$this->model->changePassword();
	}
}
