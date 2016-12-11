<?php
class ControllerHomeUnregistred extends Controller{
    public function index() {
        $data = array();
        $this->load->language('home');
        $data['greeting'] = $this->language->get('greeting');
        $data['options'] = $this->language->get('options');
        $data['option1'] = $this->language->get('option1');
        $data['option2'] = $this->language->get('option2');
        $data['option3'] = $this->language->get('option3');        
        $data['ref_sign_up'] = $this->response->url('auth/signup');
        $data['ref_signin_cust'] = $this->response->url('auth/login/c');
        $data['ref_signin_master'] = $this->response->url('auth/login/m');
        
        return $this->load->view('home_unregisterd', $data);
    }
}
