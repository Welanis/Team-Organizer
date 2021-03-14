<?php

if(!isset($SEC))
	die('404 Not Found');

class user {
	
	private static $core;
	private static $user;
		
	public function __construct($id)
	{
		self::$core = core::getInstance();
		
		$sql = "SELECT * FROM `users` WHERE `userId`=$id";

		$stmt = self::$core->dbh->prepare($sql);
		$stmt->execute();

		self::$user = $stmt->fetch();
			
	}
	
	public function getUsername()
	{
		return self::$user['username'];
	}
	
	
}


?>