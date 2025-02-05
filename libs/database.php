﻿<?php

if (!defined('snowboards')) header('Location: /');

class Database extends PDO {
	public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
		// Connection data (server_address, database, username, password)
		parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
		//parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
	}
	
	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
		$sth = $this->prepare($sql);
		
		foreach ($array as $key => $value) {
			$sth->bindValue("$key", $value);
		}

		$sth->execute();
		return $sth->fetchAll($fetchMode);
	}
	
	public function rowCount($sql, $array = array()) {
		$sth = $this->prepare($sql);
		
		foreach ($array as $key => $value) {
			$sth->bindValue("$key", $value);
		}
		$sth->execute();
		return $sth->rowCount();
	}
	
	public function insert($table, $data) {
		$fieldNames = implode('`, `', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
		
		$stmt = "INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)";
		
		$sth = $this->prepare($stmt);
		
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
	}
	
	public function update($table, $data, $where)
	{
		$fieldDetails = NULL;
		foreach($data as $key => $value) {
			$fieldDetails .= "`$key`=:$key,";
		}
		$fieldDetails = rtrim($fieldDetails, ',');
		
		$sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
		
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
	}
	
	public function delete($table, $where, $limit = 1) {
		return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
	}
}
