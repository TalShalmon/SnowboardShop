<?php

if (!defined('snowboards')) header('Location: /');

class Home extends Controller {
	function __construct() {
		parent::__construct();
		
		$this->view->title = 'ברוכים הבאים';
		$this->view->js = array('home.js');
		$this->view->css = array('home.css');
	}
	
	function index() {
		$this->view->render('home');
	}
	
	function getProductsList() {
		Core::checkReferer();
		
		$this->view->productList = $this->model->getProductsList();
	}
}
