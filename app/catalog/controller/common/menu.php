<?php
class ControllerCommonMenu extends Controller {
    public function index($param) {
        $this->load->language('common/menu');
        $menu = array();

        $link = strtoupper($this->request->server['REQUEST_URI']);
        
        $item = array('caption'=> $this->language->get('home'),
        'link'=> $this->response->url('home'),
        'active'=> strstr($link, 'HOME') === FALSE ? 0 : 1);
        $menu[] = $item;

        $item = array('caption'=> $this->language->get('about'),
        'link'=> $this->response->url('about'),
        'active'=> strstr($link, 'ABOUT') === FALSE ? 0 : 1);
        $menu[] = $item;       
        
        $item = array('caption'=> $this->language->get('customers'),
        'link'=> $this->response->url('customeroffice'),
        'active'=> strstr($link, 'CUSTOMEROFFICE') === FALSE ? 0 : 1);
        $menu[] = $item;       
        
        /*
        $item = array('caption'=> $this->language->get('masters'),
        'link'=> $this->response->url('masteroffice'),
        'active'=> strstr($link, 'MASTEROFFICE') === FALSE ? 0 : 1);
        $menu[] = $item;               
      
        $item = array('caption'=> $this->language->get('support'),
        'link'=> $this->response->url('support'),
        'active'=> strstr($link, 'SUPPORT') === FALSE ? 0 : 1);
        $menu[] = $item;               
        */
        $data['menu'] = $menu;
        
        return $this->load->view('common/menu', $data);
    }
}
