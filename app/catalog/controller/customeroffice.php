<?php
class ControllerCustomeroffice extends Controller {
    private function login() {
        $this->load->language('auth/customer_login');
        $sidebar = '';
        $menu = $this->load->controller('common/menu');        
        $header = $this->load->controller('common/header',$menu);
        
        $footer = $this->load->controller('common/footer');
        
        $data['header'] = $header;
        $data['menu'] = $menu;
        $data['sidebar'] = $sidebar;
        $data['footer'] = $footer;

        $form_data['form_title'] = $this->language->get('form_title');
        $form_data['login_title'] = $this->language->get('login_title');
        $form_data['password_title'] = $this->language->get('password_title');
        $form_data['redirect'] = $this->response->url('customeroffice');
        $form_data['action'] = $this->response->url('auth/login');
        $form_data['submit_title'] = $this->language->get('submit_title');
        $form_data['warning'] = '';
        if(isset($this->session->data['login_fail'])){
            unset($this->session->data['login_fail']);
            $form_data['warning'] = $this->language->get('warning');
        }
        
        $content = $this->load->view('auth/login', $form_data);
        $data['content'] = $content;
        
        
        $body = $this->load->view('home', $data);
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();         
    }

    public function index() {
        if(!$this->user->isLoggedIn()){
            $this->login();
            return;
        }        
        
        $this->load->language('home');
        
        $sidebar = $this->load->controller('common/sidebar');
        $menu = $this->load->controller('common/menu');        
        $header = $this->load->controller('common/header',$menu);
        
        $footer = $this->load->controller('common/footer');
        
        $data['header'] = $header;
        $data['menu'] = $menu;
        $data['sidebar'] = $sidebar;
        $data['footer'] = $footer;

        $content = $this->language->get('shortly_about');
        $data['content'] = $content;
        
        
        $body = $this->load->view('home', $data);
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();          
    }
    
    
}
