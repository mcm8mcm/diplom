<?php
class ControllerHome extends Controller{
    public function index() {
        $this->load->language('home');
        $header = $this->load->controller('common/header');
        
        
        $sidebar = $this->load->controller('common/sidebar');        
        $footer = $this->load->controller('common/footer');
        $menu = $this->load->controller('common/menu');
        
        $data['header'] = $header;
        $data['menu'] = $menu;
        $data['sidebar'] = $sidebar;
        $data['footer'] = $footer;
        $data['greeting'] = $this->language->get('greeting');
        $data['short_about'] = $this->language->get('short_about');
        
        
        $body = $this->load->view('home', $data);
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($header); 
        $this->document->addBody($body);
        $this->document->addBody($footer); 
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();        
    }  
}
