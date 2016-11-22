<?php
class Request{
    public $get = array();
    public $post = array();
    public $files = array();
    public $server = array();
    public $cookie = array();
    public $request = array();
    
    
    public function __construct() {
        $_GET = $this->clean($_GET);
        $_POST = $this->clean($_POST);
        $_FILES = $this->clean($_FILES);
        $_SERVER = $this->clean($_SERVER);
        $_COOKIE = $this->clean($_COOKIE);
        $_REQUEST = $this->clean($_REQUEST);
        
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->server = $_SERVER;
        $this->cookie = $_COOKIE;
        $this->request = $_REQUEST;
    }
    
    private function clean($data){
        if(is_array($data)){
            foreach ($data as $key=>$val){
                unset($data[$key]);
                
                $data[$this->clean($key)] = $this->clean($val);
            }
        }else{
            $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
        }
        
        return $data;
    }
}
