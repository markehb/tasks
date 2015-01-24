<?php

namespace tasks\category\add;

class AddTaskCategory {
    
    public function __construct(){
        echo "<h2>Add a Task Category</h2>";
    }
    
    public function addCategoryForm() {
        
       echo '<form action="" method="post">';
       echo '<label>Category Name</label><input type="text" name="categoryName" id="categoryName" /><br/>';
       echo '<input type="submit" name="submit" value="Add Task Category" />';
       echo '</form>';
    }
    
}