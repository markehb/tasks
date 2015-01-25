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
    private $stmt;
    
    public function __construct() {
        
        try {
            $this->db = new \PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME.';charset=utf8', self::DB_USER, self::DB_PASS);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->db->setAttribute(\PDO::ATTR_PERSISTENT, true);
        } catch(\PDOException $ex) {
            echo "An Error occured!"; //user friendly message
            //some_logging_function($ex->getMessage());
            echo $ex->getMessage();
        }
    }
    
    /**
     * For query statements
     * @param type $freshQuery
     * @return type
     */
    public function query($query) {
        
        $this->stmt = $query;
        
        try {
            $this->stmt = $this->db->prepare($this->stmt);
        } catch(\PDOException $ex) {
            echo "An Error occured: " . $ex->getMessage();
        }
        
    }
    
    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
              case is_int($value):
                $type = \PDO::PARAM_INT;
                break;
              case is_bool($value):
                $type = \PDO::PARAM_BOOL;
                break;
              case is_null($value):
                $type = \PDO::PARAM_NULL;
                break;
              default:
                $type = \PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute(){
        return $this->stmt->execute();
    }
    
    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function single(){
        $this->execute();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function rowCount(){
        return $this->stmt->rowCount();
    }
    
}
