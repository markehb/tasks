<?php

namespace task\add;

class AddTask {
    
    private $db;
    private $taskName;
    private $taskDescription;
    private $taskCategoryId;
    private $taskPriorityId;
    private $taskStatusId;
    private $taskCategoryOptions;
    private $taskPriorityOptions;
    private $taskStatusOptions;
    
    public function __construct($db){
        
        $this->db = $db;
        
    }
    
    public function addTaskToDb($taskArray){
        
        if(is_array($taskArray)) {
            $this->taskName = $taskArray['taskName'];
            $this->taskDescription = $taskArray['taskDesc'];
            $this->taskCategoryId = cint($taskArray['taskCategoryId']);
            $this->taskPriorityId = cint($taskArray['taskPriorityId']);
            $this->taskStatusId = cint($taskArray['taskStatusId']);
            
            die("ADD PARAMETERS TO THIS QUERY");
            $freshQuery = "INSERT INTO tasks";
            $freshQuery .= " (task_name, task_description, task_category_id, task_priority_id, task_status_id)";
            $freshQuery .= " VALUES ('".$this->taskName."','".$this->taskDescription."','".$this->taskCategoryId."','".$this->taskPriorityId."','".$this->taskStatusId."');";
            // above should be parameterised
            
            $this->db->databaseConnect();
            $queryResult = $this->db->databaseExec($freshQuery);
            var_dump($queryResult);
            
        } else {
            die('An unexpected error has occured.');
        }
        
    }
    
    public function buildTaskFormSelects() {
        
        $this->db->databaseConnect();
            
        $dbQuery = $this->db->databaseQuery("SELECT category_id, category_name FROM categories");        
        $this->taskCategoryOptions = $dbQuery->fetchAll(\PDO::FETCH_ASSOC); // return the rows from the select query
        
        $dbQuery = $this->db->databaseQuery("SELECT priority_id, priority_name FROM priorities");
        $this->taskPriorityOptions = $dbQuery->fetchAll(\PDO::FETCH_ASSOC); // return the rows from the select query
        
        $dbQuery = $this->db->databaseQuery("SELECT status_id, status_name FROM status");
        $this->taskStatusOptions = $dbQuery->fetchAll(\PDO::FETCH_ASSOC); // return the rows from the select query
        
    }
    
    // it's bad form to access properties directly, so we use getter methods
    public function getTaskCategoryOptions() {
        return $this->taskCategoryOptions;
    }
    
    // it's bad form to access properties directly, so we use getter methods
    public function getTaskPriorityOptions() {
        return $this->taskPriorityOptions;
    }
    
    // it's bad form to access properties directly, so we use getter methods
    public function getTaskStatusOptions() {
        return $this->taskStatusOptions;
    }
}
