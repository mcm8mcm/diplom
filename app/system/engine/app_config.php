<?php
    
class AppConfig {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function setOption($option, $scope, $val, $value) {
        $opt_key = strtolower($option).'_'.strtolower($scope).'_'.((string)$val);
        $sql = "SELECT * FROM `options` WHERE `name`='".$opt_key."'";
        $res = $this->db->sql($sql);
        if($res['rows_count']){
            $sql = "UPDATE `options` SET `value`='".$value."' WHERE `name`='".$opt_key."'";
        } else {
            $sql = "INSERT INTO `options` (`name`,`value`) VALUES ('".$opt_key."','".$$value."')";            
        }
        
        $this->db->sql($sql);
        return $this->db->rowsAffected();
    }
    
    public function getOption($option, $scope, $val) {
        $opt_key = strtolower($option).'_'.strtolower($scope).'_'.((string)$val);
        $sql = "SELECT * FROM `options` WHERE `name`='".$opt_key."'";
        $res = $this->db->sql($sql);

        if($res['rows_count']){
            return $res['row']['value'];
        } else {
            return FALSE;            
        }        
    }
    
}
