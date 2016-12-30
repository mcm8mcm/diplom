<?php
class ControllerCommonMenu extends Controller {
    public function index($param) {
        $this->load->language('common/menu');
        $menu = array();

        $item = array('caption'=> $this->language->get('home'),
        'link'=> $this->response->url('home'),
        'active'=> 0);
        $menu[] = $item;

        $item = array('caption'=> $this->language->get('about'),
        'link'=> $this->response->url('about'),
        'active'=> 0);
        $menu[] = $item;       
        
        $item = array('caption'=> $this->language->get('customers'),
        'link'=> $this->response->url('customeroffice'),
        'active'=> 0);
        $menu[] = $item;       

        $item = array('caption'=> $this->language->get('masters'),
        'link'=> $this->response->url('masteroffice'),
        'active'=> 0);
        $menu[] = $item;               
      
        $item = array('caption'=> $this->language->get('support'),
        'link'=> $this->response->url('support'),
        'active'=> 0);
        $menu[] = $item;               
        
        $data['menu'] = $menu;
        $data['langmenu'] = $this->load->controller('common/langmenu');
        
        return $this->load->view('common/menu', $data);
    }
}
