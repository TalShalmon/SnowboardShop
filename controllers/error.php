<?php

if (!defined('snowboards')) header('Location: /');

class Error extends Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->view->title = ' - unknown error';
		$this->view->msg = 'שגיאה לא מוכרת';
		$this->view->render('error');
	}
	
	function error_404() {
		$this->view->title = ' - error 404';
		$this->view->error = 404;
		$this->view->msg = 'דף זה אינו קיים';
		$this->view->render('error');
	}
	
	function error_1() {
		if (Session::get('loggedIn') == true) {
			header('Location: ' . URL);
			return;
		}
		
		$this->view->title = ' - error';
		$this->view->msg = 'משתמש לא קיים או סיסמה לא נכונה';
		$this->view->render('error');
	}
	
	function error_2() {
		$this->view->title = ' - error';
		$this->view->msg = 'משתמש חסום, נא לפנות למנהל';
		$this->view->render('error');
	}
	
	function error_3() {
		$this->view->title = ' - error';
		$this->view->msg = 'משתמש לא פעיל, נא לבצע אקטיבציה באמצעות המייל שנשלח<br />' .
				'במידה ולא הגיע, יש לבדוק בתיקיית הספאם, אחרת, ' .
				'<a href="' . URL . 'user/forgotPassword">לחץ כאן לקבלת מייל אקטיבציה חדש</a>';
		$this->view->render('error');
	}
}
