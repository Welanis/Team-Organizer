<?php
/**
* File containing common global functions, ie. file loaders
*/

//DB configurations
config::write('db.host', 'localhost');
config::write('db.name', 'mydb');
config::write('db.user', 'root');
config::write('db.password', '');	

//global variables
config::write('root', dirname(__FILE__));

//Design configurations
config::write('tasks.order', '`taskName`,`taskDescription`,`deadline`,`taskResponsibility`,`status`');
config::write('tasks.header', array("Task","Description","Deadline","Responsibility","Progress"));

config::write('table.task.class', 'task-view');


//Status
config::write('status.code', array("Not started", "In progress", "Dependencie", "Stuck", "Done"));
config::write('status.color', array("#ff6666", "#ffff66", "#ff0080", "#990000", "#009900"));

?>