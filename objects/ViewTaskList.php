<?php

namespace task\viewList;

class ViewTaskList {
    
    private $db;
    private $status;
    
    public function __construct($db){
        
        $this->db = $db;
        
    }
    
    public function listTasks($status = null) {
        
        $this->status = ($status == 'open')? "WHERE task_id > 1" : 'WHERE task_id = 1'; 
        $buildQuery = "SELECT t.task_id, t.task_name, t.task_description, t.task_category_id, t.task_priority_id, t.task_status_id,";
        $buildQuery .= " c.category_name, p.priority_name, s.status_name";
        $buildQuery .= " FROM tasks t";
        $buildQuery .= " LEFT JOIN categories c ON t.task_category_id = c.category_id";
        $buildQuery .= " LEFT JOIN priorities p ON t.task_priority_id = p.priority_id";
        $buildQuery .= " LEFT JOIN status s ON t.task_status_id = s.status_id";
        $buildQuery .= " " . $this->status . " ORDER BY task_priority_id DESC";
        $query = $this->db->query($buildQuery);
        return $this->db->resultset();
        
    }
    
}
