<?php
/* It's bootstrap time */

require 'database.class.php';
require 'addTaskCategories.class.php';

$dbConn = new database\database();

$addTaskCategory = new tasks\category\add\AddTaskCategory($dbConn);
$addTaskCategory->addCategoryForm();

