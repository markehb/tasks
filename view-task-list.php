<?php

require 'objects/database.php';
require 'objects/viewTaskList.php';

$dbConn = new database\Database();
$taskList = new task\viewList\ViewTaskList($dbConn);

$tasks = $taskList->listTasks();

foreach ($tasks as $task) {
    
    echo $task['task_name'] . "<br/>";
    
}