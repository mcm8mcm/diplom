<?php
class DB {
    private $connection = false;
    
    public function __construct($host, $login, $password, $database, $port='3306') {
	
        $this->$connection = mysqli_connect($host, $user, $password, (int)$port);       
        
        if(!$this->$connection){
            throw new Exception('Could not connect to db server');
        }
        
        $res = mysqli_select_db($this->$connection, $database);
        
        if(!$res){
            throw new Exception('Could not connect to database '.$database);            
        }
        
        mysqli_query("SET NAMES 'utf8'", $this->$connection);
        mysqli_query("SET CHARACTER SET utf8", $this->$connection);
    }
    
    public function sql($query) {
        
    }
    
    public function escape($sql) {
        return mysqli_real_escape_string($this->connection, $sql);
    }
    
    public function __destruct() {
        if($this->$connection){
            mysqli_close($this->$connection);
        }
    }
}
