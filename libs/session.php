<?php

if (!defined('snowboards')) header('Location: /');

class Session {
	public static function init() {
		@session_start();
		
		if (!isset($_SESSION['EXPIRES']) || $_SESSION['EXPIRES'] < time()) {
			Session::destroy();
			@session_start();
		}
		$_SESSION['EXPIRES'] = time() + 3600;
	}

	public static function set($key, $value) {
		$_SESSION[$key] = $value;
	}

	public static function get($key) {
		if (isset($_SESSION[$key]))
			return $_SESSION[$key];
	}

	public static function destroy() {
		header('Location: ' . URL);
		session_destroy();
	}
}
