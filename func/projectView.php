<?php

if(!isset($SEC))
	die('404 Not Found');

class ProjectView extends Project {	

	private static $userbuff = array();
	
	public function preworkTasks($tasks) {
		for ($i = 0; count($tasks) > $i; $i++) {
			
			$tasks[$i]['taskResponsibility'] = self::username($tasks[$i]['taskResponsibility']);
			
			$tasks[$i]['deadline'] = date('d.m.Y', $tasks[$i]['deadline']);
			
			$tasks[$i]['status'] = self::status($tasks[$i]['status']);
		}
		return $tasks;
	}
	
	private function username($id) {
		print key_exists($id, self::$userbuff);
		//print self::$userbuff[$id];
		
		if(!key_exists($id, self::$userbuff)) {
			$user = new user($id);
			
			self::$userbuff[$id] = $user->getUsername();
			return self::$userbuff[$id];	
		}
		else {
			return self::$userbuff[$id];
		}
	}
	
	private function status($int) {
		$temp = config::read("status.code");
		$color = config::read("status.color");
		
		$return = '<span style="background:' . $color[$int] . ';">' . $temp[$int] . '</span>';
		
		return $return;
	}
	
	public function test() {
		print var_dump(parent::$project);
	}
}


?>