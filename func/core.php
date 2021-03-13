<?php
if(!isset($SEC))
	die('404 Not Found');

class config {
	
	static $confarray;
	
	public static function write($name, $value) {
		
		if (!isset(self::$confarray[$name])) {
			self::$confarray[$name] = $value;
			return(1);
		}
		else {
			trigger_error("Cannot set configuration twice!", E_USER_ERROR);
			return 0;
		}
	}
	
	public static function read($name)
	{
		if(is_null(self::$confarray[$name]))
			return 0;
		else
			return self::$confarray[$name];
	}
	
}

class core
{
	public $dbh; // handle of the db connexion
	private static $instance;

	private function __construct()
	{
		// building data source name from config
		$dsn = 'mysql:host=' . config::read('db.host') .
		';dbname='    . config::read('db.name') .
		';connect_timeout=15';
		// getting DB user from config
		$user = config::read('db.user');
		// getting DB password from config
		$password = config::read('db.password');

		$this->dbh = new PDO($dsn, $user, $password);
	}

	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			$object = __CLASS__;
			self::$instance = new $object;
		}
		return self::$instance;
	}



	// others global functions
}



?>