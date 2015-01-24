<?php

require 'objects/database.php';
require 'objects/addTask.php';

$dbConn = new database\Database();

$taskArray['taskName'] = 'Test Task Name';
$taskArray['taskDesc'] = 'Test Task Description';
$taskArray['taskCategoryId'] = 1;
$taskArray['taskPriorityId'] = 2;
$taskArray['taskStatusId'] = 3;

$addTask = new task\add\AddTask($dbConn);
$addTask->addTaskToDb($taskArray);
