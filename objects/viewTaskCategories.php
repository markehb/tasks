<?php

namespace tasks\categories\listcats;

class viewTaskCategories {
    
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function viewTaskCategories() {
        
        $this->db->databaseConnect();
        $dbQuery = $this->db->databaseQuery('SELECT * FROM categories;');
        
        while($row = $dbQuery->fetch(\PDO::FETCH_ASSOC)) {
            echo $row['category_id'].' '.$row['category_name ']; //etc...
        }
                
    }
}
