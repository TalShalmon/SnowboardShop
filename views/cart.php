<?php
	if (!defined('snowboards'))
		header('Location: /');
?>

<h1><?php echo $this->title ?></h1>
<h2>דף זה איננו פעיל כעת</h2>
<input type="submit" id="return" value="חזרה" onclick="returnToHome()" />