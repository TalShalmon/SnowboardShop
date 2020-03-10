<?php

if (!defined('snowboards')) header('Location: /');

class Cart extends Controller {
	function __construct() {
		parent::__construct();	
	}
	
	function index() {	
		$this->view->title = 'עגלת קניות';
		$this->view->css = array('cart.css');
		$this->view->js = array('cart.js');
		
		$this->view->render('cart');
	}
}
