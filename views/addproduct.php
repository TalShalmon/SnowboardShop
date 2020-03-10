<?php
	if (!defined('snowboards'))
		header('Location: /');
?>

<h1><?php echo $this->title ?></h1>
<div id="add_product_form">
	<fieldset class="adding">
		<label class="label" for="name">שם המוצר:</label>
		<input class="input" type="text" name="name" id="name" onblur="checkName();" title="שדה זה חייב להכיל שם המוצר" required>
		<label class="message" id="name-msg"></label>
	</fieldset>
	<fieldset class="adding">
		<label class="label" for="manufacture">יצרן:</label>
		<select class="input" name="manufacture" id="manufacture" onblur="clearOldMessages('manufacture-msg');"></select>
		<label class="message" id="manufacture-msg"></label>
	</fieldset>
	<fieldset class="adding">
		<label class="label" for="profiletype">סוג פרופיל:</label>
		<select class="input" name="profile_type" id="profiletype" onblur="clearOldMessages('profile_type-msg');"></select>
		<label class="message" id="profile_type-msg"></label>
	</fieldset>
	<fieldset class="adding">
		<label class="label" for="size">גודל:</label>
		<input class="input" type="text" name="size" id="size" onblur="clearOldMessages('size-msg');" title="שדה זה חייב להכיל את אורך המגלש" required>
		<label class="message" id="size-msg"></label>
	</fieldset>
	<fieldset class="adding">
		<label class="label" for="width">רוחב:</label>
		<select class="input" name="width" id="width" onblur="clearOldMessages('width-msg');"></select>
		<label class="message" id="width-msg"></label>
	</fieldset>
	<fieldset class="adding">
		<label class="label" for="abilitylevel">רמת קושי:</label>
		<select class="input" name="ability_level" id="abilitylevel" onblur="clearOldMessages('ability_level-msg');"></select>
		<label class="message" id="ability_level-msg"></label>
	</fieldset>
	<fieldset class="adding">
		<label class="label" for="gender">מגדר:</label>
		<select class="input" name="gender" id="gender" onblur="clearOldMessages('gender-msg');"></select>
		<label class="message" id="gender-msg"></label>
	</fieldset>
	<fieldset class="adding">
		<label class="label" for="price">מחיר:</label>
		<input class="input" type="text" name="price" id="price" onblur="clearOldMessages('price-msg');" title="שדה זה חייב להכיל את מחיר הוצר" required>
		<label class="message" id="price-msg"></label>
	</fieldset>
	<fieldset class="adding">
		<input type="submit" id="adding-submit" value="הרשם" onclick="addProduct(<?php echo $_FILES; ?>)" />
	</fieldset>
</div>
