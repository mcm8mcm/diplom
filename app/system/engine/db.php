<?php
class DB {
    private $connection = false;
    
    public function __construct($host, $login, $password, $database, $port='3306') {
	
        $this->connection = mysqli_connect($host.':'.$port, $login, $password, $database);       
        
        if(!$this->connection){
            throw new Exception('Could not connect to db server');
        }
        
        mysqli_query($this->connection, "SET NAMES 'utf8'");
        mysqli_query($this->connection, "SET CHARACTER SET utf8");
    }
    
    public function sql($query) {
        $res = mysqli_query($this->connection, $query);
        $res_array = array('row' => array(), 'rows' => array(), 'rows_count' => 0);
        if($res){
                if($res instanceof mysqli_result){
                    while($tmp = mysqli_fetch_assoc($res)){
                        $res_array['rows'][] = $tmp;
                    }
                    $res_array['rows_count'] = count($res_array['rows']);
                    if($res_array['rows_count']){
                        $res_array['row'] = $res_array['rows'][0];
                    }
                }            
        } else {
            throw new Exception(mysqli_error ( $this->connection ));
        }
        
        return $res_array;
    }
    
    public function escape($sql) {
        return mysqli_real_escape_string($this->connection, $sql);
    }
    
    public function rowsAffected($param) {
        return mysqli_affected_rows($connect);
    } 
    
    public function __destruct() {
        if($this->connection){
            mysqli_close($this->connection);
        }
    }
}
