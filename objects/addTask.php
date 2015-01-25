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
    private $query;
    
    public function __construct($db){
        $this->db = $db;
        
    }
    
    public function addTaskToDb($taskArray){
        
        if(is_array($taskArray)) {
            $this->taskName = $taskArray['taskName'];
            $this->taskDescription = $taskArray['taskDesc'];
            $this->taskCategoryId = (int)$taskArray['taskCategoryId'];
            $this->taskPriorityId = (int)$taskArray['taskPriorityId'];
            $this->taskStatusId = (int)$taskArray['taskStatusId'];
            
            $this->query = "INSERT INTO tasks";
            $this->query .= " (task_name, task_description, task_category_id, task_priority_id, task_status_id)";
            $this->query .= " VALUES (:name,:desc,:catid,:priorityid,:statusid);";
            $this->db->query($this->query);
            
            $this->db->bind(':name', $this->taskName);
            $this->db->bind(':desc', $this->taskDescription);
            $this->db->bind(':catid', $this->taskCategoryId);
            $this->db->bind(':priorityid', $this->taskPriorityId);
            $this->db->bind(':statusid', $this->taskStatusId);
            
            $this->db->execute();
            //var_dump($queryResult);
            
        } else {
            die('An unexpected error has occured.');
        }
        
    }
    
    public function buildTaskFormSelects() {
        
        $dbQuery = $this->db->query("SELECT category_id, category_name FROM categories");        
        $this->taskCategoryOptions = $this->db->resultset();
        
        $dbQuery = $this->db->query("SELECT priority_id, priority_name FROM priorities");
        $this->taskPriorityOptions = $this->db->resultset();
        
        $dbQuery = $this->db->query("SELECT status_id, status_name FROM status");
        $this->taskStatusOptions = $this->db->resultset();
        
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
