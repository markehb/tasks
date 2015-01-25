<?php

require 'objects/Database.php';
require 'objects/ViewTaskList.php';
require 'objects/TaskControls.php';

include 'includes/header.php';

$dbConn = new database\Database();
$taskList = new task\viewList\ViewTaskList($dbConn);
$controlTask = new task\add\TaskControls($dbConn);

$controlTask->buildTaskFormSelects(); // get the select options

// handle task adding
if ($_POST) {

    $taskArray['taskName'] = $_POST['taskName'];
    $taskArray['taskDesc'] = $_POST['taskDesc'];
    $taskArray['taskCategoryId'] = $_POST['taskCategory'];
    $taskArray['taskPriorityId'] = $_POST['taskPriority'];
    $taskArray['taskStatusId'] = $_POST['taskStatus'];

    $controlTask->addTaskToDb($taskArray);
    
    //success message
    $successMessage = 'Task has been added.';
    
} elseif(isset($_GET['del'])) {
    
    $taskId = (int)filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT);
    
    try {
        $controlTask->deleteTask($taskId);
        $successMessage = 'Task has been deleted.';
    } catch(Exception $e) {
        $errorMessage = $e->getMessage();
    }
}

// Error and success notices
if(isset($errorMessage)) {
    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error..</strong> '.$errorMessage.'</div>';
    
} elseif(isset($successMessage)) {
    echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> '.$successMessage.'</div>';
}


// show list of open tasks
$tasksOpen = $taskList->listTasks('open');
echo '<h1>Open Tasks</h1><table class="table table-striped table-bordered table-hover">'."\n<tbody>\n";
echo "<th>Name</th><th>Category</th><th>Priority</th><th>Status</th>";
foreach ($tasksOpen as $task) {
    
    $editThisRow = false;
    
    if(isset($_GET['edit'])) {
        
        if((int)filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT) == $task['task_id']) {
            $editThisRow = true;
        }
    }
    
    if($editThisRow === true) {
        echo '<tr><td><input type="text" name="taskName" value="'.$task['task_name'] . '" /></td>'."\n";
        echo "<td>".$task['category_name'] . "</td>\n";
        echo "<td>".$task['priority_name'] . "</td>\n";
        echo "<td>".$task['status_name'] . "</td>\n";
        echo '<td><a href="?close='.$task['task_id'].'" class="glyphicon glyphicon-copyright-mark"></a></td>'."\n";
        echo '<td>editing row</td>'."\n";
        echo '<td><a href="?del='.$task['task_id'].'" class="glyphicon glyphicon-trash"></a></td></tr>'."\n";
        echo '<tr><td colspan="7"><small>Description: '.$task['task_description'].'</small></td></tr>'."\n";
    } else {
        echo "<tr><td>".$task['task_name'] . "</td>\n";
        echo "<td>".$task['category_name'] . "</td>\n";
        echo "<td>".$task['priority_name'] . "</td>\n";
        echo "<td>".$task['status_name'] . "</td>\n";
        echo '<td><a href="?close='.$task['task_id'].'" class="glyphicon glyphicon-copyright-mark"></a></td>'."\n";
        echo '<td><a href="?edit='.$task['task_id'].'" class="glyphicon glyphicon-pencil"></a></td>'."\n";
        echo '<td><a href="?del='.$task['task_id'].'" class="glyphicon glyphicon-trash"></a></td></tr>'."\n";
        echo '<tr><td colspan="7"><small>Description: '.$task['task_description'].'</small></td></tr>'."\n";
    }
}
echo '<form action="index.php" method="post">';
echo '<tr><td><div class="controls"><input id="taskName" name="taskName" placeholder="Enter task name" class="input-xlarge" required="" type="text"></div></td>';
echo '<td><div class="controls"><select id="taskCategory" name="taskCategory" class="input-xlarge">';

echo '<option> - Select task category - </option>';
$categoryOptions = $controlTask->getTaskCategoryOptions();
foreach($categoryOptions As $categoryOption){
    echo '<option value="'.$categoryOption['category_id'].'">'.$categoryOption['category_name'].'</option>';
}
echo '</select></div></td>';

echo '<td><div class="controls"><select id="taskPriority" name="taskPriority" class="input-xlarge">';
echo '<option> - Select task priority - </option>';
$priorityOptions = $controlTask->getTaskPriorityOptions();
foreach($priorityOptions As $priorityOption){
    echo '<option value="'.$priorityOption['priority_id'].'">'.$priorityOption['priority_name'].'</option>';
}
echo '</select></div></td>';

echo '<td><div class="controls"><select id="taskStatus" name="taskStatus" class="input-xlarge">';
echo '<option> - Select task status - </option>';
$statusOptions = $controlTask->getTaskStatusOptions();
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