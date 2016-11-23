<?php
class Response{
    private $cookies = array();
    private $headers = array();
    
    public function __construct() {
        
    }
    
    public function addHeader($header) {
        $this->headers[] = $header;
    }
    
    public function addCookie($key, $value) {
        $this->cookies[$key] = $value;
    }
    
    public function flush($output){
        if(!headers_sent()){
            foreach ($this->headers as $header) {
                header($header);
            }
            
            foreach ($this->cookies as $name => $value) {
                setcookie($name, $value);
            }
        }
        
        echo $output;
    }
}