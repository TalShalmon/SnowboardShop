<?php
	if (!defined('snowboards'))
		header('Location: /');
?>

<h1><?php
	if (isset($this->error))
		echo 'שגיאה ' . $this->error . ' - ';
	
	echo $this->msg;
?></h1>
