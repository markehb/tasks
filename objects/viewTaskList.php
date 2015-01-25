<?php

namespace task\viewList;

class ViewTaskList {
    
    private $db;
    
    public function __construct($db){
        
        $this->db = $db;
        
    }
    
    public function listTasks() {
        
        $query = $this->db->query("SELECT task_id, task_name FROM tasks ORDER BY task_priority_id DESC");
        return $this->db->resultset();
        
    }
    
}
