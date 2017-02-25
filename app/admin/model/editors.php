<?php
class ModelEditors extends Model {
    
    public function getUserGroups(){
        $sql = 'SELECT * FROM `'.DB_PREFIX.'user_group`';
        $res = $this->db->sql($sql);
        return $res['rows'];
    }
    
    public function getUsers() {
        $sql = 'SELECT `u`.*, ' 
        .'`ugroup`.`name` as `group_name` '
        .'FROM '. DB_PREFIX .'`users` AS `u` LEFT JOIN '
        .DB_PREFIX.'`user_group`  AS `ugroup` ON `u`.`group` = `ugroup`.`id`';
        $users = array();
        $res = $this->db->sql($sql);
        $users = $res['rows'];
        $groups = array();
        $groups = $this->getUserGroups();
        $lang = $this->getLanguages();
        return array('user'=>$users, 'groups'=>$groups, 'lang'=>$lang);
    }
    
    public function getNews() {
        return(array());
    }

    public function getFooterData() {
        return(array());

    }

    public function getLanguages() {
        $sql = 'SELECT * FROM `'.DB_PREFIX.'languages`';
        $res = $this->db->sql($sql);
        return($res['rows']);        
    }

    public function getFlags() {
        $toret = array();
        $path = ICLUDE_URL.DS.'img'.DS.'flags';
        $files = scandir(APP_PATH.DS.$path);
        
        foreach ($files as $value) {
            if($value === '.' || $value === '..') continue;
            $toret[] = $path.DS.$value;
        }
        
        return $toret;
    }
    
    public function getTasks() {
        return(array());
    }
    
    public function postUser($data) {
        $groups = $this->getUserGroups();
        $group_id = '';
        foreach ($groups as $value) {
            if($value['name'] === $data['user_group']){
                $group_id = $value['id'];
                break;
            }
        }
        $sql = "UPDATE `".DB_PREFIX."users` SET "
                ."`first_name` = '".$data['first_name']."', "
                ."`patronymic` = '".$data['patronymic']."', "
                ."`last_name` = '".$data['lastname']."', "
                ."`login` = '".$data['login']."', "
                ."`pwd` = '".$data['pwd']."', "
                ."`password` = '".md5($data['pwd'])."', "
                ."`email` = '".$data['email']."', "
                ."`group` = ".$group_id.", "
                ."`active` = ".$data['isactive'].", "
                ."`session_id` = '".$data['cur_sess_id']."', "
                ."`language` = '".$data['user_lang']."', "
                ."`reg_expired` = '".$data['reg_expired']."' "
                ."WHERE `id`=" . $data['user_id'];
        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString();
        }
        
        return $toret;
    }
    
    public function addUser($data) {
        $groups = $this->getUserGroups();
        $group_id = '';
        foreach ($groups as $value) {
            if($value['name'] === $data['user_group']){
                $group_id = $value['id'];
                break;
            }
        }

        $sql = "INSERT INTO `".DB_PREFIX."users`(`first_name`,"
                . "`patronymic`,"
                . "`last_name`,"
                . "`login`,"
                . "`pwd`,"
                . "`password`,"
                . "`email`,"
                . "`group`,"
                . "`active`,"
                . "`session_id`,"
                . "`language`,"
                . "`reg_expired`) VALUES('".$data['first_name']."',"
                . "'".$data['patronymic']."',"
                . "'".$data['lastname']."',"
                . "'".$data['login']."',"
                . "'".$data['pwd']."',"
                . "'".md5($data['pwd'])."',"
                . "'".$data['email']."',"
                .$group_id.","
                .$data['isactive'].","
                . "'".$data['cur_sess_id']."',"
                . "'".$data['user_lang']."',"
                . "'".$data['reg_expired']."')";

        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $sql.PHP_EOL.$exc->getTraceAsString();
        }
        
        return $toret;       
    }
}
