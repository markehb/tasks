<?php

namespace task\add;

class AddTask {
    
    private $db;
    private $taskName;
    private $taskDescription;
    private $taskCategoryId;
    private $taskPriorityId;
    private $taskStatusIs;
    
    public function __construct($db){
        
        $this->db = $db;
        
    }
    
    public function addTaskToDb($taskArray){
        
        if(is_array($taskArray)) {
            $this->taskName = $taskArray['taskName'];
            $this->taskDescription = $taskArray['taskDesc'];
            $this->taskCategoryId = $taskArray['taskCategoryId'];
            $this->taskPriorityId = $taskArray['taskPriorityId'];
            $this->taskStatusId = $taskArray['taskStatusId'];
            
            $freshQuery = "INSERT INTO tasks";
            $freshQuery .= " (task_name, task_description, task_category_id, task_priority_id, task_status_id)";
            $freshQuery .= " VALUES ('".$this->taskName."','".$this->taskDescription."','".$this->taskCategoryId."','".$this->taskPriorityId."','".$this->taskStatusId."');";
            // above should be parameterised
            
            $this->db->databaseConnect();
            $queryResult = $this->db->databaseQuery($freshQuery);
            var_dump($queryResult);
            
        } else {
            die('An unexpected error has occured.');
        }
        
    }
    
}
