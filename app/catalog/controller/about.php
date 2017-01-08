<?php
class ControllerAbout extends Controller{
    public function index() {
        $sidebar = $this->load->controller('common/sidebar');
        $menu = $this->load->controller('common/menu');        
        $header = $this->load->controller('common/header',$menu);
        
        $footer = $this->load->controller('common/footer');
        
        $data['header'] = $header;
        $data['menu'] = $menu;
        $data['sidebar'] = $sidebar;
        $data['footer'] = $footer;
        
        $this->load->language('about');

        $content = $this->language->get('about_us');
        
        $prices = $this->load->controller('prices');
        
        $data['content'] = $content.PHP_EOL.$prices;
             
        $body = $this->load->view('about', $data);
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();        
    }     
}
