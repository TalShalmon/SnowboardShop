<?php
if (!defined('snowboards')) header('Location: /');

class Controller {
	function __construct() {
		Session::init();
		$this->view = new View();
	}
	
	public function loadModel($name) {
		$modelName = $name . MODEL_SUFIX;
		$modelFile = MODELS . $modelName . '.php';
		
		if (file_exists($modelFile)) {
			require $modelFile;
			
			$this->model = new $modelName();
		}
	}
}
