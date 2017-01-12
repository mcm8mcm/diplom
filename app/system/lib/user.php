<?php
class User {
    private $login = '';
    private $name = '';    
    private $user_id = '';
    private $language = '';    
    
    public function __construct($register) {
        $tmp_user_id = '-1';
       
        if(isset($register->get('session')->data['user'])){
            if(isset($register->get('session')->data['user']['id'])){
               $tmp_user_id = $register->get('session')->data['user']['id'];
            }
            unset($register->get('session')->data['user']);
        }
            
        $register->get('session')->data['user'] = array();
        
        //Check if this user still active and legally logged in.
        $tmp_sess_id = $register->get('session')->getId();
        $sql = "SELECT * FROM `users` WHERE `id` = $tmp_user_id AND `session_id` = '$tmp_sess_id' AND `active` = 1";
        
        $res = $register->get('db')->sql($sql);
        if($res['rows_count'] == 1){;
            $register->get('session')->data['user']['id'] = $res['row']['id'];
            $this->login = $res['row']['login'];
            $this->name = $res['row']['first_name'].' '.$res['row']['patronymic'].' '.$res['row']['last_name'];
            $this->id = $res['row']['id'];
            $this->language = $res['row']['language'];
        }
    }
    
    public function login($register, $user_id = '', $login = '', $password = '') {
        if(!empty($user_id)){
           $sql = "SELECT * FROM `users` WHERE `id` = $user_id AND `active` = 1";    
        } else {
           $sql = "SELECT * FROM `users` WHERE UPPER(`login`) = '" . strtoupper($login). "'AND `password` = '" . md5($password) . "'  AND `active` = 1";  
        }
        
        $res = $register->get('db')->sql($sql);
        if($res['rows_count'] == 1){
            $this->login = $res['row']['login'];
            $this->name = $res['row']['first_name'].' '.$res['row']['patronymic'].' '.$res['row']['last_name'];
            $this->id = $res['row']['id'];
            $this->language = $res['row']['language'];
            
            if(!isset($register->get('session')->data['user'])){
                $register->get('session')->data['user'] = array();
            }
            
            $tmp_sess_id = $register->get('session')->getId();
            $register->get('session')->data['user']['id'] = $res['row']['id']; 
            $sql = "UPDATE `users` set `session_id` = '$tmp_sess_id' where id = " . $register->get('session')->data['user']['id'];
            $register->get('db')->sql($sql);
            return true;
        }
        
        return false;
    }
    
    public function logout($user_id) {
        $this->login = '';
        $this->name = '';
        $this->user_id = '';
        $this->language = '';
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
    
    public function setLang($lang, $register) {
        if($this->language !== $lang){
            if($this->isLoggedIn()){
                $sql = "UPDATE TABLE `users` SET `language` = '" . $lang . "' WHERE `id` = $this->user_id";
                $register->get('db')->sql($sql);
                if($register->get('db')->rowsAffected()){
                    $this->language = $lang;
                }
            }
        }
    }
    
}
