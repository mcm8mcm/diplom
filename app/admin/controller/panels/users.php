<?php
class ControllerPanelsUsers extends Controller {
    public function index() {

        if(!$this->user->isLoggedIn()){
            $this->response->redirect($this->response->url('login'));
        }
        
        $this->load->language('controlpanel');
        
        $header = $this->load->controller('common/header');
        $sidebar = $this->load->controller('common/sidebar');        
        $content = $this->load->controller('editors/edusers');
        $body = $this->load->view('common/controlpanel', array('header' => $header, 'sidebar' => $sidebar, 'admincontent' => $content));
          
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();          
    }    
}
