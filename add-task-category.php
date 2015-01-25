<?php
/* It's bootstrap time */

require 'objects/database.class.php';
require 'objects/addTaskCategory.php';

$dbConn = new database\Database();

$addTaskCategory = new tasks\categories\add\AddTaskCategory($dbConn);
$addTaskCategory->displayTaskCategoryForm();

$categoryName = 'this is a test';
$addTaskCategory->addTaskCategoryToDb($categoryName);

