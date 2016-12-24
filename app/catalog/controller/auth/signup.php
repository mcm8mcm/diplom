<?php
class ControllerAuthSignup extends Controller{
    public function index() {
        $data = array();
        $this->load->language('auth/signup');
        $data['fn_first_name'] = $this->language->get('fn_first_name');
        $data['fn_patronymic'] = $this->language->get('fn_patronymic');
        $data['fn_last_name'] =  $this->language->get('fn_last_name');
        $data['fn_address'] =  $this->language->get('fn_address');
        $data['fn_email'] =  $this->language->get('fn_email');
        $data['bn_sign_up'] =  $this->language->get('bn_sign_up');
        $data['bn_cancel'] =  $this->language->get('bn_cancel');
        $data['fn_login'] =  $this->language->get('fn_login');
        $data['fn_password'] =  $this->language->get('fn_password');
        $data['fn_password1'] =  $this->language->get('fn_password1');
        
        $data['reg_action'] = $this->response->url('auth/signup/signup');
        $data['cancel_action'] = $this->response->url('home');        
        
        $header = $this->load->controller('common/header');
        $signup_form = $this->load->view('auth/signup', $data);        
        $footer = $this->load->controller('common/footer');
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($header); 
        $this->document->addBody($signup_form);
        $this->document->addBody($footer); 
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();        
    }
    
    public function signup() {
        $this->load->model('auth/signup');
        ddd($this->model_auth_signup);
        throw new Exception('Not emplemented yet');
    }
}
