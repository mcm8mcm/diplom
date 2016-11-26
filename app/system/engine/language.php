<?php
class Language {
    private $data = array();
    private $dir_lang = '';
    
    public function __construct($dir_lang) {
        $this->dir_lang = $dir_lang;
    }
    
    public function load($path) {
        $file = $this->dir_lang.$path.'.php';
        if(is_file($file)){
            $_ = array();
            include($file);
            $this->data = array_merge($this->data, $_);
        }else{
            throw new Exception("Could not load language module ".$file);
        }
    }
    
    public function get($key) {
        if(isset($this->data[$key])){
            return $this->data[$key];
        }
    }
}
