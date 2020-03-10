<?php
if (!defined('snowboards')) header('Location: /');

class Core {
	function __construct() {
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		
		$url = rtrim($url, '/');
		// Remove all characters, except letters, digits and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);

		$page = $url[0];
		if ($page == 'error') {
			$this->error('error_404');
			return false;
		}
		$page_controller = CONTROLLERS . $page . '.php';
		if (file_exists($page_controller)) {
			require_once $page_controller;
		} else {
			$this->error('error_404');
			return false;
		}
		
		$controller = new $page;
		$controller->loadModel($page);
		
		// calling methods
		if (!isset($url[1])) {
			if (method_exists($controller, "index")) {
				$controller->index();
			} else {
				$this->error('error_404');
			}
		} else {
			if (method_exists($controller, $url[1])) {
				if (!isset($url[2])) {
					$controller->{$url[1]}();
				} else {
					$reflection = new ReflectionMethod ($controller, $url[1]);
					$args = $reflection->getParameters();
					if (!empty($args)) {
						$controller->{$url[1]}($url[2]);
					} else {
						$this->error('error_404');
					}
				}
			} else {
				$this->error('error_404');
			}
		}
	}

	function error($arg = null) {
		require_once CONTROLLERS . 'error.php';
		$controller = new Error();
		if (isset($arg)) {
			$controller->{$arg}();			
		} else {
			$controller->index();
		}
		return false;
	}
	
	function checkReferer() {
		if (!isset($_SERVER["HTTP_REFERER"])) {
			Core::error('error_404');
		}
	}
}
