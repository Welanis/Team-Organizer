<?php
if(!isset($SEC))
	die('404 Not Found');
/**
* Class that handles everything that has to do with a project.
* Viewing, editing, adding, deleting projects.
*/
//include_once(".\core.php");
//include_once(".\config.php");


class Project {
	
	protected static $project;
	protected static $tasks;
	protected static $core;
	protected static $numTasks;
	
	public function __construct($projectID = 0) {
		//Get database connection
		if(!self::$core)
			self::$core = core::getInstance();

		
		//Get project list
		$sql = "SELECT * FROM `projects` WHERE `projectID`='$projectID'";

		$stmt = self::$core->dbh->prepare($sql);
		$stmt->execute();
		self::$project = $stmt->fetch(PDO::FETCH_ASSOC);
		
		self::$numTasks = self::getNumTask();
		
		return 1;
	}
	
	/**
	* 
	* @return int returns number of tasks in the current project instance 
	* 
	*/	
	
	protected function getNumTask() {
		$PID = self::$project['projectID'];
		
		$SQL = "SELECT COUNT(*) FROM `tasks` WHERE `parentProjectId`=$PID";
		$stmt = self::$core->dbh->prepare($SQL);
		$stmt->execute();
		$return = $stmt->fetch();
		return $return[0];
		
	}
	
	/**
	* 
	* @param str $order Orders the columns, standard is *
	* @param {object} $limit Sets upper limit to how many rows to show
	* @param {object} $offset Offset to the limit to gather more tasks.
	* 
	* @return array returns all rows of tasks
	*/
	public function getTasks($order = '*', $limit = 50, $offset = 0) {
		//Failsafe to prevent stack overflow
		if ($limit > 200)
			$limit = 50;
		
		$upperLimit = $limit+$offset;


		$sql = "SELECT $order FROM `tasks` WHERE `parentProjectId`='".self::$project['projectID']."' ORDER BY `taskId` DESC LIMIT $offset, ".$upperLimit;
		$stmt = self::$core->dbh->prepare($sql);
		$stmt->execute();
		
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);		
		
	
	}
	
	public function id() {
		return self::$projectId;
	}
	
	public function name() {
		return self::$project['projectName'];
	} 
	
	public function description() {
		return self::$project['projectDescription'];
	}

	public function created() {
		return date(DATE_RSS, self::$project['timestamp']);
	}
	
	/* Prints creator ID, must be parsed through a users class */
	public function creator() {
		return self::$project['projectCreator'];
	}
	
	public function numTasks() {
		return self::$numTasks;
	}
	
	public function updateName($name = null) {
		if ($name) {
			$sql = "UPDATE `projects` SET `projectName`='$name' WHERE `projectID`='" . self::$project['projectID'] . "'";
			$stmt = self::$core->dbh->prepare($sql);
			$stmt->execute();
			
			self::$project['projectName'] = $name;
		}
	}


	
	/**
	* Debugging functions. Dumps the self::$project array.
	* Set private once done!
	* 
	* @return
	*/
	public function dumpProject() {
		var_dump(self::$project);
	}
}




class Task extends Project {
	
	private static $id;
	private static $task;
	
	public function __construct($taskID = 0, $order = '*') {
		
		if(!self::$core)
			self::$core = core::getInstance();
		
		$sql = "SELECT $order FROM `tasks` WHERE `taskID`='".$taskID."'";
		$stmt = self::$core->dbh->prepare($sql);
		$stmt->execute();
		
		
		$buffer = $stmt->fetch(PDO::FETCH_ASSOC);
		
		foreach($buffer as $k => $v) {
			//print "$k => $v <br />";
			
			if($k == 'taskID') {
				self::$id = $v;
				//print "id:$v <br />";
			}
			
			else {
				self::$task[$k] = $v;
				//print "$v <br />";
			}
		}
		//var_dump(self::$task);	
		parent::__construct(self::$task['parentProjectId']);
		
		return 1;
			
	}
	
	public function get_public_data() {
		return self::$task;
	}
	
	public function taskId() {
		return self::$id;
	}
	
	public function taskName() {
		return self::$task['taskName'];
	}
	
	public function taskDescription($TaskID) {
		return self::$task['taskDescription'];
	}
	
	public function status() {
		return self::$task['status'];
	}
	
	public function owner() {
		return self::$task['taskResponsibility'];
	}
	
	public function deadline() {
		return self::$task['deadline'];
	} 
	
}

?>