<?php

namespace tasks\categories\add;

class AddTaskCategory {
    
    private $db;
    
    /**
     * constructor method
     * @param type $db
     */
    public function __construct($db) {
        
        echo "<h2>Add a Task Category</h2>";
        $this->db = $db;
    }
    
    /**
     * displays form for category
     */
    public function displayTaskCategoryForm() {
        
       echo '<form action="" method="post">';
       echo '<label>Category Name</label><input type="text" name="categoryName" id="categoryName" /><br/>';
       echo '<input type="submit" name="submit" value="Add Task Category" />';
       echo '</form>';
    }
    
    /**
     * Method for adding new task category
     */
    public function addTaskCategoryToDb($categoryName) {
        
        $freshQuery = "INSERT INTO categories (category_name) VALUES ('".$categoryName."')";
        $this->db->databaseConnect();
        $this->db->databaseQuery($freshQuery);
    }
    
}