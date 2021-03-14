<?php


class ProjectView extends Project {	
	
	public function preworkTasks() {
		
		$tasks = parent::getTasks();
		
		for ($i = 0; count($tasks) < $i; $i++) {
			$user = new user($tasks[$i]['responsibility']);
			$task[$i]['responsibility'] = $user->getUsername();
			
			$tasks[$i]['deadline'] = date(DATE_RSS, $tasks[$i]['deadline']);
		}	
		return $tasks;
	}
}


?>