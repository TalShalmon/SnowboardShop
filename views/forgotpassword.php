<?php
	if (!defined('snowboards'))
		header('Location: /');
?>

<h1><?php echo $this->title ?></h1>
<div id="activation_form">
	<fieldset class="activation">
		<label class="label" for="username">מייל:</label>
		<input class="input" type="text" name="user_name" id="username" onfocus="clearMessage();" title="שדה זה חייב להכיל כתובת מייל" required>
		<label class="message" id="username-msg"></label>
	</fieldset>
	<fieldset class="activation">
		<input type="submit" id="activation-submit" value="שלח" onclick="submitActivationForm()" />
	</fieldset>
</div>
