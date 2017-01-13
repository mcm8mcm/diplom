<?php
class User {
    private $login = '';
    private $name = '';    
    private $user_id = '';
    private $language = '';  
    private $group = '';
    private $db;
    private $session;
    
    public function __construct($register) {
        $tmp_user_id = '-1';
        $this->db = $register->get('db');
        $this->session = $register->get('session');
        
        $ses_id = $this->session->getID();
        if(!empty($ses_id)){
            $sql = "SELECT * FROM `".DB_PREFIX."users` WHERE `session_id` = '".$ses_id."'";
            $res = $this->db->sql($sql);
            if($res['rows_count']){
                $this->login = $res['row']['login'];
                $this->name = $res['row']['first_name'].' '.$res['row']['last_name'];
                $this->user_id = $res['row']['id'];
                $this->language = $res['row']['language']; 
                $this->group = $res['row']['group']; 
            }
        }
    }
    
    public function login($login, $password) {
        $login = $this->db->escape($login);
        $password = $this->db->escape($password);
        $login = strtoupper($login);
        $password = md5($password);
        $sql = "SELECT * FROM `".DB_PREFIX."users` WHERE (UPPER(`login`) = '".$login."' OR "
                . "UPPER(`email`) = '".$login."') AND `password` = '".$password."' AND `active` = 1";
        $res = $this->db->sql($sql);
        if(!$res['rows_count']){
            $this->session->data['login_fail'] = 1;
            return;
        }
        
        $this->login = $res['row']['login'];
        $this->name = $res['row']['first_name'].' '.$res['row']['last_name'];
        $this->user_id = $res['row']['id'];
        $this->language = $res['row']['language'];
        $this->group = $res['row']['group'];
        
        $sql = "UPDATE `".DB_PREFIX."users` SET `session_id`='".$this->session->getID()."' WHERE `id` = ".$this->user_id;
        $this->db->sql($sql);  
        
    }
    
    public function logout() {
        if(!empty($this->user_id)){
            $sql = "UPDATE `".DB_PREFIX."users` SET `session_id`='' WHERE `id` = ".$this->user_id;
            $this->db->sql($sql);
        }
        
        $this->login = '';
        $this->name = '';
        $this->user_id = '';
        $this->language = '';
        $this->group = "";
    }
    
    public function isLoggedIn() {
        return !empty($this->user_id);
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getLogin() {
        return $this->login;
    }

    public function getID() {
        return $this->user_id;
    }
    
    public function getLang() {
        return $this->language;
    }
    
    public function isAdmin() {
        return $this->group === '1';
    }
    
    public function isMaster() {
        return $this->group === '2';
    }
    
    public function isCustomer() {
        return $this->group === '3';
    }
    
    public function setLang($lang) {
        if($this->language !== $lang){
            if($this->isLoggedIn()){
                $sql = "UPDATE `".DB_PREFIX."users` SET `language` = '" . $lang . "' WHERE `id` = ".$this->user_id;
                $this->db->sql($sql);
                if($this->db->rowsAffected()){
                    $this->language = $lang;
                }
            }
        }
    }
    
}
