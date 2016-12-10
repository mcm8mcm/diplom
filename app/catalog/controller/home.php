<?php
class ControllerHome extends Controller{
    public function index() {
        $this->load->language('home');
        $header = $this->load->controller('common/header');
        
        $data['greeting'] = $this->language->get('greeting');
        $body = $this->load->view('home', $data);
        
        $footer = $this->load->controller('common/footer');
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($header); 
        $this->document->addBody($body);
        $this->document->addBody($footer); 
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();        
    }  
}
