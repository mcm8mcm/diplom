<?php
class ControllerLogin  extends Controller{
    public function index() {
        $header = $this->load->controller('header');
    }
    
    public function login($login, $password){
        $type = $this->request->post['user_type'];
        $redirect_addr = $this->request->post['redirect'];
        $login = $this->request->post['username'];
        $password = $this->request->post['password'];
        $this->user->login($login,$password);  
        return;
    }
}
