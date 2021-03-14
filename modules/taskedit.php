<?php
if(!isset($SEC))
	die('404 Not Found');

$task = new Task(2);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Hei</title>
		<link rel="stylesheet" href="<?php print config::read('root'); ?>\style.css" />
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" /> 
		<meta http-equiv="Pragma" content="no-cache" /> 
		<meta http-equiv="Expires" content="0" />
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
			$table = new Table(array('Task name', 'Task Description', 'Status', 'Deadline', 'Owner'), config::read('table.task.class'));
			$form = new Form('get', 'taskEdit');
			
			foreach($task->get_public_data() as $k => $v) {
				
				if($k == 'deadline')
						$form->addField($k, 'date', date('Y-m-d', $v));
				
				elseif($k == 'parentProjectId')
					$form->addField($k, 'text', $task->);
				
				else
					$form->addField($k, 'text', $v);
				
				
			}
			
			$form->createSubmit('test');

			$form->generateForm();
			
			print $form->output();
			
			
			//$table->input(array(array('test','test','test','test','test')));
			
			//$form->addField();
			
			
			$table->output();
			
			
			?>

		</div>
		<div class="footer">
			<!-- Footer goes here -->
		</div>
	</body>
</html>