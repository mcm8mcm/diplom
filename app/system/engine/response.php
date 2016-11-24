<?php
class Response{
    private $cookies = array();
    private $headers = array();
    private $output;
    
    public function __construct() {
        $output = '';
    }
    
    public function addHeader($header) {
        $this->headers[] = $header;
    }
    
    public function addCookie($key, $value) {
        $this->cookies[$key] = $value;
    }
    
    public function setOutput($output) {
        $this->output = $output;
    }
    
    public function flush(){
        if(!headers_sent()){
            foreach ($this->headers as $header) {
                header($header);
            }
            
            foreach ($this->cookies as $name => $value) {
                setcookie($name, $value);
            }
        }
        
        echo $this->output;
    }
}