<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class Register{
    private $register;

    public function __construct(){
        $this->register = array();
    }
    
    public function __get($name) {
        if(array_key_exists($name, $this->register)){
            return $this->register[$name];
        } else {
            return NULL;
        }
    }
    
    public function __set($name, $value) {
        $this->register[$name] = $value;
    }
}
