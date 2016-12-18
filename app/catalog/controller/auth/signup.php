<?php
class ControllerAuthSignup extends Controller{
    public function index() {
        $data = array();
        $this->load->language('auth/signup');
 
        $data['fn_first_name'] = $this->language->get('fn_first_name');
        $data['fn_patronymic'] = $this->language->get('fn_patronymic');
        $data['fn_last_name'] =  $this->language->get('fn_last_name');
        $data['reg_action'] = $this->response->url('auth/signup/signup');
        
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
        throw new Exception('Not emplemented yet');
    }
}
