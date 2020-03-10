<?php

	if (!defined('snowboards'))
		header('Location: /');

class Product extends Controller {
	function __construct() {
		parent::__construct();
	}
	
	function showInfo($arg = null) {
		if ($arg == null) {
			return;
		}
		
		$product = $this->model->getProductInfo($arg);
		
		
		if (!isset($product[0])) {
			Core::error('error_404');
			return;
		}
		
		$reviews = $this->model->getProductReviews($arg);
		
		$usersName = $this->model->getUsersName();
		
		$this->view->css = array('product.css');
		$this->view->js = array('product.js');
		$this->view->product = $product[0];
		$this->view->reviews = array_reverse($reviews);
		$this->view->usersName = $usersName;
		$this->view->render('product');
	}
	
	function getReviews() {
		Core::checkReferer();
		
		$arg = $_POST['product'];
		$reviews = $this->model->getProductReviews($arg);
		
		$productReviews = array();
		foreach ($reviews as $review) {
			$review['username'] = $this->model->getUsersName($review['reviewed_by']);
			$productReviews[] = $review;
		}
		
		echo json_encode($productReviews);
	}
	
	function add() {
		if ((Session::get('admin')) == false) {
			header('Location: ' . URL);
			return;
		}
		$this->view->title = 'הוספת מוצר חדש';
		$this->view->css = array('form.css', 'addproduct.css');
		$this->view->js = array('addproduct.js');
		
		$this->view->render('addproduct');
	}
	
	function getManufactureList() {
		Core::checkReferer();
		
		$this->view->manufactureList = $this->model->getManufactureList();
	}
	
	function getProfileTypeList() {
		Core::checkReferer();
		
		$this->view->profileTypeList = $this->model->getProfileTypeList();
	}
	
	function getWidthList() {
		Core::checkReferer();
		
		$this->view->widthList = $this->model->getWidthList();
	}
	
	function getAbilityLevelList() {
		Core::checkReferer();
		
		$this->view->abilityLevelList = $this->model->getAbilityLevelList();
	}
	
	function getGenderList() {
		Core::checkReferer();
		
		$this->view->genderList = $this->model->getGenderList();
	}
	
	function checkProductExists() {
		Core::checkReferer();
		
		$this->view->productExist = $this->model->checkProductExists();
	}
	
	function addProduct() {
		Core::checkReferer();
		
		$this->model->addProduct();
	}
	
	function addReview() {
		Core::checkReferer();
		
		$this->model->addReview();
	}
}
