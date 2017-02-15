<?php
class ControllerLogin  extends Controller{
    public function index() {
        $header = $this->load->controller('common/header');
        $content = $this->load->controller('common/loginform');
        $data = array();
        
        $data['header'] = $header;
        $data['sidebar'] = '';
        $data['admincontent'] = $content;
        $body = $this->load->view('common/controlpanel', $data);
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();                
    }
    
    public function login(){
        $redirect_addr = $this->request->post['redirect'];
        $login = $this->request->post['username'];
        $password = $this->request->post['password'];
        $this->user->login($login,$password);  
      
        if(!$this->user->isLoggedIn()){
            $this->index();
            return;
        }
        
        if(!$this->user->isAdmin()){
            $this->user->logout();
            $this->session->data['login_fail'] = 1;
            $this->index();
            return;
        }
    }
}
