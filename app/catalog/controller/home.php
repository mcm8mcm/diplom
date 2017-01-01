<?php
class ControllerHome extends Controller{
    public function index() {
        $this->load->language('home');
        
        $sidebar = $this->load->controller('common/sidebar');
        $menu = $this->load->controller('common/menu');        
        $header = $this->load->controller('common/header',$menu);
        
        $footer = $this->load->controller('common/footer');
        
        $data['header'] = $header;
        $data['menu'] = $menu;
        $data['sidebar'] = $sidebar;
        $data['footer'] = $footer;
        $content = '<H1>'.$this->language->get('greeting').'</H1>'.PHP_EOL;
        $content .= $this->language->get('short_about').PHP_EOL;
        $data['content'] = $content;
        
        
        $body = $this->load->view('home', $data);
        
        $this->document->setTitle($this->language->get('title'));
       // $this->document->addBody($header); 
        $this->document->addBody($body);
       // $this->document->addBody($footer); 
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();        
    } 
    
    public function error404() {
        $this->load->language('home');
        
        $sidebar = $this->load->controller('common/sidebar');
        $menu = $this->load->controller('common/menu');        
        $header = $this->load->controller('common/header',$menu);
        
        $footer = $this->load->controller('common/footer');
        
        $data['header'] = $header;
        $data['menu'] = $menu;
        $data['sidebar'] = $sidebar;
        $data['footer'] = $footer;
        $data['content'] = $this->load->controller('common/404');

        $body = $this->load->view('home', $data);
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();        
    }
}
