﻿<?php

if (!defined('snowboards')) header('Location: /');

class Form {
	/* var array $_currentItem The immediately posted item*/
	private $_currentItem = null;
	
	/* var array $_postData Stores the Posted Data */
	private $_postData = array();
	
	/* var object $_val The validator object */
	private $_val = array();
	
	/* var array $_error Holds the current forms errors */
	private $_error = array();
	
	public function __construct() {
		$this->_validating = new FormValidator();
	}
	
	/*
	 * post - This is to run $_POST
	 * param string $field - The HTML fieldname to post
	 */
	public function post($field) {
		$this->_postData[$field] = $_POST[$field];
		$this->_currentItem = $field;
		
		return $this;
	}
	
	public function set($field, $value = null) {
		$this->_postData[$field] = $value;
		
		return $this;
	}
	
	public function replace($value) {
		$this->_postData[$this->_currentItem] = $value;
		
		return $this;
	}
	
	/*
	 * fetch - Return the posted data
	 * param mixed $fieldName
	 * return mixed String or array
	 */
	public function fetch($fieldName = false) {
		if ($fieldName) {
			if (isset($this->_postData[$fieldName]))
				return $this->_postData[$fieldName];
			
			else
				return false;
		} else {
			return $this->_postData;
		}
	}
	
	/*
	 * val - This is to validate
	 * param string $typeOfValidator A method from the Form/Val class
	 * param string $arg A property to validate against
	 */
	public function validate($typeOfValidator, $arg = null) {
		if (empty($this->_error[$this->_currentItem])) {
			if ($arg == null) {
				$error = $this->_validating->{$typeOfValidator}($this->_postData[$this->_currentItem]);
			} else {
				$error = $this->_validating->{$typeOfValidator}($this->_postData[$this->_currentItem], $arg);
			}
			
			if ($error) {
				$this->_error[$this->_currentItem] = $error;
			}
		}
		return $this;
	}
	
	/*
	 * submit - Handles the form, and throws an exception upon error.
	 * return boolean
	 * throws Exception 
	 */
	public function submit() {
		if (empty($this->_error)) {
			return true;
		} else {
			$str = '';
			foreach ($this->_error as $key => $value) {
				$str .= $key . ' => ' . $value . ",";
			}
			$str = rtrim($str, ',');
			throw new Exception($str);
		}
	}
}
