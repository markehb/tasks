<?php
/* It's bootstrap time */

require 'objects/database.php';
require 'objects/viewTaskCategories.php';

$dbConn = new database\Database();

$addTaskCategory = new tasks\categories\add\AddTaskCategory($dbConn);
$addTaskCategory->displayTaskCategoryForm();

$viewTaskCategories = new tasks\categories\listCats\viewTaskCategories($dbConn);
$viewTaskCategories->viewTaskCategories();

