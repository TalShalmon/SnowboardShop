<?php
	if (!defined('snowboards'))
		header('Location: /');
?>

<h1><?php echo $this->title ?></h1>
<div id="register_form">
	<fieldset class="signing">
		<label class="label" for="username">מייל:</label>
		<input class="input" type="text" name="user_name" id="username" onblur="checkUsername();" title="שדה זה חייב להכיל כתובת מייל" required>
		<label class="message" id="username-msg"></label>
	</fieldset>
	<fieldset class="signing">
		<label class="label" for="firstname">שם פרטי:</label>
		<input class="input" type="text" name="first_name" id="firstname" onblur="clearOldMessages('first_name-msg');" title="שדה זה חייב להכיל שם פרטי בעברית" required>
		<label class="message" id="first_name-msg"></label>
	</fieldset>
	<fieldset class="signing">
		<label class="label" for="surname">שם משפחה:</label>
		<input class="input" type="text" name="sur_name" id="surname" onblur="clearOldMessages('sur_name-msg');" title="שדה זה חייב להכיל שם משפחה בעברית" required>
		<label class="message" id="sur_name-msg"></label>
	</fieldset>
	<fieldset class="signing">
		<label class="label" for="city">עיר:</label>
		<select class="input" name="city" id="city" onblur="clearOldMessages('city-msg');"></select>
		<label class="message" id="city-msg"></label>
	</fieldset>
	<fieldset class="signing">
		<label class="label" for="address">כתובת:</label>
		<input class="input" type="text" name="address" id="address" onblur="clearOldMessages('address-msg');" title="שדה זה חייב להכיל כתובת" required>
		<label class="message" id="address-msg"></label>
	</fieldset>
	<fieldset class="signing">
		<label class="label" for="phone">טלפון:</label>
		<input class="input" type="text" name="phone" id="phone" onblur="clearOldMessages('phone-msg');" title="שדה זה חייב להכיל מספר טלפון" required>
		<label class="message" id="phone-msg"></label>
	</fieldset>
	<fieldset class="signing">
		<input type="submit" id="signing-submit" value="הרשם" onclick="submitRegisterForm()" />
	</fieldset>
</div>
