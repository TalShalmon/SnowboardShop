<?php

	if (!defined('snowboards'))
		header('Location: /');


define('URL', '/');
define('LIBS', 'libs/');
define('CONTROLLERS', 'controllers/');
define('VIEWS', 'views/');
define('MODELS', 'models/');
define('MODEL_SUFIX', '_Model');
define('IMAGES', 'public/images/');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'snowboards_db');
define('DB_USER', 'root');
define('DB_PASS', '7450434');

define ('SLOGEN', 'SnowBoarding החנות הוירטואלית #1 בישראל<br />' . "\n\t\t\t" . 'שמנו לעצמנו למטרה לקדם את ענף הסנובורדינג בישראל<br />' . "\n");
define ('COPYRIGHTS', 'כל הזכויות שמורות לטל שלמון ונדב גרינברג - 2012&copy;' . "\n");

// The sitewide hashkey, do not change this because its used for passwords!
// This is for database passwords only
define('HASH_PASSWORD_KEY', 'Shalmon&GreenbergSnowBoard2012WebSite');

