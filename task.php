<?php

include_once("./load.php");


//$project = new Project(1);
$view = new ProjectView(1);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Hei</title>
		<link rel="stylesheet" href=".\style.css" />
	</head>
	<body>
		<div class="header">
			<!-- Header Goes here -->
		</div>
		<div class="main-body">
			<p>
				<h1>Welcome!</h1>
				<h2>Task organizing and teamwork made easy</h2>
			</p>
			
			<?php
			$table = new Table(config::read('tasks.header'), config::read('table.task.class'));

			$table->input($view->preworkTasks($view->getTasks(config::read('tasks.order'))));
			
			$table->output();
			?>
			
		</div>
		<div class="footer">
			<!-- Footer goes here -->
		</div>
	</body>
</html>
?>