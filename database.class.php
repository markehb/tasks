<?php

namespace database;

/*$db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'username', 'password');*/
/*http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers*/

class database {
    
    // when using constants in methods, have to use self:: instead of $this->
    const DB_HOST = 'localhost';
    const DB_NAME = 'tasks';
    const DB_USER = 'tasks';
    const DB_PASS = 'tasks';
    
    public function connect() {
        
        echo "Attempt db connection";
        
        /*$this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;*/
        
        $db = new \PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME.';charset=utf8', self::DB_USER, self::DB_PASS);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        
        /*try {
            //connect as appropriate as above
            $db->query('hi'); //invalid query!
        } catch(\PDOException $ex) {
            echo "An Error occured!"; //user friendly message
            //some_logging_function($ex->getMessage());
            echo $ex->getMessage();
        }*/
    }
    
}
