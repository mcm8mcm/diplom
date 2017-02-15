<?php
class ControllerCommonLoginform extends Controller{
    public function index() {
        $this->load->language('auth/customer_login');
        $data = array();
        $data['warning'] = '';
        if(isset($this->session->data)){
            if(isset($this->session->data['login_fail'])){
                $data['warning'] = $this->language->get('warning');
                unset($this->session->data['login_fail']);
            }
        }
        
        $data['redirect'] = '';
        $data['form_title'] = $this->language->get('form_title');
        $data['login_title'] = $this->language->get('login_title');
        $data['password_title'] = $this->language->get('password_title');    
        $data['submit_title'] = $this->language->get('submit_title'); 
        $data['action'] = $this->response->url('login/login');
        return $this->load->view('auth/loginform', $data);
    }
}
