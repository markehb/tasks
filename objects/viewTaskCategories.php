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
        
        echo "note1: if this only shows 1 result when we expect more, then change 'fetch' to 'fetchAll' below";
        while($row = $dbQuery->fetch(\PDO::FETCH_ASSOC)) {
            echo $row['category_id'].' '.$row['category_name ']; //etc...
        }
                
    }
}
