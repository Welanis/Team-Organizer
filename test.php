<?php
include('.\load.php');


?>
<!DOCTYPE html>
<html>
<body>
<?php

$task = new Task(2);

print $task->name();

?>
</body>
</html>