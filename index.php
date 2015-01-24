<?php
/* It's bootstrap time */

require 'database.class.php';
require 'addTaskCategories.class.php';

$dbConn = new database\database();
$dbConn->connect();

$addTaskCategory = new tasks\category\add\AddTaskCategory();
$addTaskCategory->addCategoryForm();

