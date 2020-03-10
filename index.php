<?php
define ('snowboards', true);
require_once 'config.php';

function __autoload($class) {
	require_once LIBS . strtolower($class) . ".php";
}

$app = new Core();
