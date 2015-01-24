<?php

namespace database;

/*$db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'username', 'password');*/
/*http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers*/

class Database {
    
    // when using constants in methods, have to use self:: instead of $this->
    const DB_HOST = 'localhost';
    const DB_NAME = 'tasks';
    const DB_USER = 'tasks';
    const DB_PASS = 'tasks';
    private $db;
    private $query;
    
    public function databaseConnect() {
        
        echo "<h3>Attempt db connection</h3>";
        
        try {
            $this->db = new \PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME.';charset=utf8', self::DB_USER, self::DB_PASS);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            echo "db connected";
        } catch(\PDOException $ex) {
            echo "An Error occured!"; //user friendly message
            //some_logging_function($ex->getMessage());
            echo $ex->getMessage();
        }
    }
    
    /**
     * For select statements
     * @param type $freshQuery
     * @return type
     */
    public function databaseQuery($freshQuery) {
        
        $prepQuery = $freshQuery;
        $preppedQuery = $prepQuery;
        $this->query = $preppedQuery;
        
        try {
            $dbResult = $this->db->query($this->query);
            return $dbResult;
        } catch(\PDOException $ex) {
            echo "An Error occured: " . $ex->getMessage();
        }
        
    }
    
    /**
     * For insert, update and delete statements
     * @param type $freshQuery
     * @return type
     */
    public function databaseExec($freshQuery) {
        
        $prepQuery = $freshQuery;
        $preppedQuery = $prepQuery;
        $this->query = $preppedQuery;
        
        try {
            $dbResult = $this->db->exec($this->query);
            return $dbResult;
        } catch(\PDOException $ex) {
            echo "An Error occured: " . $ex->getMessage();
        }
        
    }
    
}
