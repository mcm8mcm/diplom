<?php
class Language {
    private $data = array();
    private $dir_lang = '';
    
    public function __construct($dir_lang) {
        $this->dir_lang = $dir_lang;
    }
    
    public function load($path) {
        $file = $this->dir_lang.DS.$path.'.php';
        
        if(!is_file($file)){
            $file = DIR_LANG.'english'.DS.$path.'.php';//try English by default
        }
             
        if(is_file($file)){
            $_ = array();
            include($file);
            $this->data = array_merge($this->data, $_);
        }else{
            throw new Exception("Could not load language module ".$file);
        }
    }
    
    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : '';
    }
}
