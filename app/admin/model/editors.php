<?php
class ModelEditors extends Model {
    public function getUsers() {
        $sql = 'SELECT `u`.*, ' 
        .'`ugroup`.`name` as `group_name` '
        .'FROM '. DB_PREFIX .'`users` AS `u` LEFT JOIN '
        .DB_PREFIX.'`user_group`  AS `ugroup` ON `u`.`group` = `ugroup`.`id`';
        $users = array();
        $res = $this->db->sql($sql);
        $users = $res['rows'];
        $groups = array();
        $sql = 'SELECT * FROM `'.DB_PREFIX.'user_group`';
        $res = $this->db->sql($sql);
        $groups = $res['rows'];
        $lang = $this->getLanguages();
        return array('user'=>$users, 'groups'=>$groups, 'lang'=>$lang);
    }
    
    public function getNews() {
        return(array());
    }

    public function getFooterData() {
        $sql = 'SELECT * FROM `'.DB_PREFIX.'languages`';
        $this->db->sql($sql);
        return($this->db->rows);
    }

    public function getLanguages() {
        
        return(array());
    }

    public function getTasks() {
        return(array());
    }
    
}
