<?php
require 'objects/database.php';
require 'objects/addTask.php';

$dbConn = new database\Database();
$addTask = new task\add\AddTask($dbConn);

if ($_POST) {

    $taskArray['taskName'] = 'Test Task Name';
    $taskArray['taskDesc'] = 'Test Task Description';
    $taskArray['taskCategoryId'] = 1;
    $taskArray['taskPriorityId'] = 2;
    $taskArray['taskStatusId'] = 3;

    $addTask->addTaskToDb($taskArray);

} else {
    
    $addTask->buildTaskFormSelects(); // get the select options
?>

<form name="addTask" action="add-task.php" method="post" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="taskName"></label>
  <div class="controls">
    <input id="taskName" name="taskName" placeholder="Enter task name" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="taskDesc"></label>
  <div class="controls">                     
    <textarea id="taskDesc" name="taskDesc">Enter task description</textarea>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="taskCategory"></label>
  <div class="controls">
    <select id="taskCategory" name="taskCategory" class="input-xlarge">
        <option> - Select task category - </option>
        <?php
        $categoryOptions = $addTask->getTaskCategoryOptions();
        foreach($categoryOptions As $categoryOption){
            echo '<option value="'.$categoryOption['category_id'].'">'.$categoryOption['category_name'].'</option>';
        }
        ?>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="taskPriority"></label>
  <div class="controls">
    <select id="taskPriority" name="taskPriority" class="input-xlarge">
        <option> - Select task priority - </option>
        <?php
        $priorityOptions = $addTask->getTaskPriorityOptions();
        foreach($priorityOptions As $priorityOption){
            echo '<option value="'.$priorityOption['priority_id'].'">'.$priorityOption['priority_name'].'</option>';
        }
        ?>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="taskStatus"></label>
  <div class="controls">
    <select id="taskStatus" name="taskStatus" class="input-xlarge">
        <option> - Select task status - </option>
        <?php
        $statusOptions = $addTask->getTaskStatusOptions();
        foreach($statusOptions As $statusOption){
            echo '<option value="'.$statusOption['status_id'].'">'.$statusOption['status_name'].'</option>';
        }
        ?>
    </select>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="addTask"></label>
  <div class="controls">
    <button id="addTask" name="addTask" class="btn btn-primary">Add Task</button>
  </div>
</div>

</fieldset>
</form>

<?php    
}
