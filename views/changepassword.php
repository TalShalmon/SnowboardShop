<?php
	if (!defined('snowboards'))
		header('Location: /');
?>

<h1><?php echo $this->title ?></h1>
<div id="activation_form">
	<fieldset class="activation">
		<label class="label" for="password">סיסמה:</label>
		<input class="input" type="password" name="password" id="password" onkeyup="testPassword();" onfocus="clearOldMessages('password-msg');" title="שדה זה חייב להכיל סיסמה">
		<label class="message" id="password-msg"></label>
	</fieldset>
	<fieldset class="activation">
		<label class="label" for="verify">אימות סיסמה:</label>
		<input class="input" type="password" name="verify" id="verify" pattern=".{5,20}" onfocus="clearOldMessages('verify-msg');" title="שדה זה חייב להכיל סיסמה">
		<label class="message" id="verify-msg"></label>
	</fieldset>
	<fieldset class="activation">
		<input type="submit" id="activation-submit" value="עדכן" onclick="submitChangePasswordForm(<?php echo $this->user['id']; ?>,<?php echo "'" . $this->user['username'] . "'"; ?>)" />
	</fieldset>
</div>
