<?php

if (!defined('snowboards')) header('Location: /');

class View {
	function __construct() {
	}

	public function render($name) {
		require_once VIEWS . 'layout.php';	
	}
}
