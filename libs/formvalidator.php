<?php

if (!defined('snowboards')) header('Location: /');

class FormValidator {
	public function __construct() {}
	
	public function minlength($data, $arg) {
		if (mb_strlen($data, 'utf8') < $arg) {
			return "אורך המחרוזת חייב להיות לפחות $arg תווים";
		}
	}
	
	public function maxlength($data, $arg) {
		if (mb_strlen($data, 'utf8') > $arg) {
			return "אורך המחרוזת חייב להיות עד $arg תווים";
		}
	}
	
	public function digits($data) {
		if (ctype_digit($data) == false) {
			return "המחרוזת חייבת להכיל ספרות בלבד";
		}
	}
	
	public function number($data) {
		if (is_numeric($data) == false) {
			return "המחרוזת חייבת להכיל ערך מספרי בלבד";
		}
	}
	
	public function value($data) {
		if ($data == 0) {
			return "עליך לבחר אופציה מהרשימה";
		}
	}
	
	public function hebrew($data) {
		if (preg_match('/^(?:\p{Hebrew}+([\s-])?)+$/iu', $data) == 0) {
			return "השדה חייב להיות בעברית";
		}
	}
	
	public function hebrewaddress($data) {
		if (preg_match('/^(?:\p{Hebrew}+([\s])?([\d])*([\/][\d]+)?([\s])?({Hebrew})*)+$/iu', $data) == 0) {
			return "השדה חייב להיות בעברית ויכול להכיל מספרים";
		}
	}
	
	public function phone($data) {
		if (preg_match('/^\d{2,3}(\-)?\d{7}/', $data) == 0) {
			return "השדה חייב להיות מספר טלפון";
		}
	}
	
	public function password_verify($data, $verify) {
		if ($data != $verify) {
			return "אימות סיסמה אינו תקין";
		}
	}

	public function __call($name, $arguments) {
		throw new Exception("$name לא קיים ב-: " . __CLASS__);
	}
}
