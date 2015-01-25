<?php

require 'objects/database.php';
require 'objects/viewTaskList.php';
require 'objects/addTask.php';

include 'includes/header.php';

$dbConn = new database\Database();
$taskList = new task\viewList\ViewTaskList($dbConn);
$addTask = new task\add\AddTask($dbConn);

$addTask->buildTaskFormSelects(); // get the select options

// handle task adding
if ($_POST) {

    $taskArray['taskName'] = $_POST['taskName'];
    $taskArray['taskDesc'] = $_POST['taskDesc'];
    $taskArray['taskCategoryId'] = $_POST['taskCategory'];
    $taskArray['taskPriorityId'] = $_POST['taskPriority'];
    $taskArray['taskStatusId'] = $_POST['taskStatus'];

    $addTask->addTaskToDb($taskArray);
    
    //success message
    echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your has been added.</div>';

}
?>


<?php
// show list of open tasks
$tasksOpen = $taskList->listTasks('open');
echo '<h1>Open Tasks</h1><table class="table table-striped table-bordered table-hover">'."\n<tbody>\n";
echo "<th>Name</th><th>Category</th><th>Priority</th><th>Status</th>";
foreach ($tasksOpen as $task) {
    echo "<tr><td>".$task['task_name'] . "</td>\n";
    echo "<td>".$task['category_name'] . "</td>\n";
    echo "<td>".$task['priority_name'] . "</td>\n";
    echo "<td>".$task['status_name'] . "</td>\n";
    echo '<td><a href="'.$task['task_id'].'">close</a></td>'."\n";
    echo '<td><a href="'.$task['task_id'].'">edit</a></td>'."\n";
    echo '<td><a href="'.$task['task_id'].'">delete</a></td></tr>'."\n";
    echo '<tr><td colspan="7">Description: '.$task['task_description'].'</td></tr>'."\n";
}
echo '<form action="index.php" method="post">';
echo '<tr><td><div class="controls"><input id="taskName" name="taskName" placeholder="Enter task name" class="input-xlarge" required="" type="text"></div></td>';
echo '<td><div class="controls"><select id="taskCategory" name="taskCategory" class="input-xlarge">';

echo '<option> - Select task category - </option>';
$categoryOptions = $addTask->getTaskCategoryOptions();
foreach($categoryOptions As $categoryOption){
    echo '<option value="'.$categoryOption['category_id'].'">'.$categoryOption['category_name'].'</option>';
}
echo '</select></div></td>';

echo '<td><div class="controls"><select id="taskPriority" name="taskPriority" class="input-xlarge">';
echo '<option> - Select task priority - </option>';
$priorityOptions = $addTask->getTaskPriorityOptions();
foreach($priorityOptions As $priorityOption){
    echo '<option value="'.$priorityOption['priority_id'].'">'.$priorityOption['priority_name'].'</option>';
}
echo '</select></div></td>';

echo '<td><div class="controls"><select id="taskStatus" name="taskStatus" class="input-xlarge">';
echo '<option> - Select task status - </option>';
$statusOptions = $addTask->getTaskStatusOptions();
foreach($statusOptions As $statusOption){
    echo '<option value="'.$statusOption['status_id'].'">'.$statusOption['status_name'].'</option>';
}
echo '</select></div></td></tr>';

echo '<tr><td colspan="4"><div class="controls"><textarea cols="100"id="taskDesc" name="taskDesc" placeholder="Enter task description" class="span12"></textarea></div></td>';
echo '<td><div class="controls"><button id="addTask" name="addTask" class="btn btn-primary">Add Task</button></div></td></tr>';
echo '</form>'."\n"; 
echo "</tbody>\n</table>\n";

// show list of closed tasks
$tasksClosed = $taskList->listTasks('closed');
echo '<h1>Closed Tasks</h1><table class="table table-striped table-bordered table-hover">'."\n<tbody>\n";
echo "<th>Name</th><th>Category</th>";
foreach ($tasksClosed as $task) {
    echo "<tr><td>".$task['task_name'] . "</td>\n";
    echo "<td>".$task['category_name'] . "</td>\n";
    echo '<td><a href="'.$task['task_id'].'">reopen</a></td>'."\n";
    echo '<td><a href="'.$task['task_id'].'">edit</a></td>'."\n";
    echo '<td><a href="'.$task['task_id'].'">delete</a></td></tr>'."\n";
}
echo "</tbody>\n</table>\n";

include 'includes/footer.php';