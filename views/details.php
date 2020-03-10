<?php
	if (!defined('snowboards'))
		header('Location: /');
?>

<h1><?php echo $this->title ?></h1>
<div id="updating_form">
	<fieldset class="updating">
		<label class="label" for="password">סיסמה:</label>
		<input class="input" type="password" name="password" id="password" onkeyup="testPassword();" onfocus="clearOldMessages('password-msg');" title="שדה זה חייב להכיל סיסמה">
		<label class="message" id="password-msg"></label>
	</fieldset>
	<fieldset class="updating">
		<label class="label" for="verify">אימות סיסמה:</label>
		<input class="input" type="password" name="verify" id="verify" pattern=".{5,20}" onfocus="clearOldMessages('verify-msg');" title="שדה זה חייב להכיל סיסמה">
		<label class="message" id="verify-msg"></label>
	</fieldset>
	<fieldset class="updating">
		<label class="label" for="first_name">שם פרטי:</label>
		<input class="input" type="text" name="first_name" id="first_name" onblur="clearOldMessages('first_name-msg');" title="שדה זה חייב להכיל שם פרטי בעברית" required>
		<label class="message" id="first_name-msg"></label>
	</fieldset>
	<fieldset class="updating">
		<label class="label" for="sur_name">שם משפחה:</label>
		<input class="input" type="text" name="sur_name" id="sur_name" onblur="clearOldMessages('sur_name-msg');" title="שדה זה חייב להכיל שם משפחה בעברית" required>
		<label class="message" id="sur_name-msg"></label>
	</fieldset>
	<fieldset class="updating">
		<label class="label" for="city">עיר:</label>
		<select class="input" name="city" id="city" onblur="clearOldMessages('city-msg');"></select>
		<label class="message" id="city-msg"></label>
	</fieldset>
	<fieldset class="updating">
		<label class="label" for="address">כתובת:</label>
		<input class="input" type="text" name="address" id="address" onblur="clearOldMessages('address-msg');" title="שדה זה חייב להכיל כתובת" required>
		<label class="message" id="address-msg"></label>
	</fieldset>
	<fieldset class="updating">
		<label class="label" for="phone">טלפון:</label>
		<input class="input" type="text" name="phone" id="phone" onblur="clearOldMessages('phone-msg');" title="שדה זה חייב להכיל מספר טלפון" required>
		<label class="message" id="phone-msg"></label>
	</fieldset>
	<fieldset class="updating">
		<input type="submit" id="update-submit" value="עדכן" onclick="submitUpdateForm()" />
	</fieldset>
</div>
