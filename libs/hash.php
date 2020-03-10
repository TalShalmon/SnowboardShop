<?php

if (!defined('snowboards')) header('Location: /');

class Hash {
	
	public static function create($algo, $salt, $data1, $data2 = null) {
		$context = hash_init($algo, HASH_HMAC, $salt);
		
		hash_update($context, $data1);
		
		if (isset($data2))
			hash_update($context, $data2);

		return hash_final($context);
	}
}
