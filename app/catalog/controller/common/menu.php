<?php
class ControllerCommonMenu extends Controller {
    public function index($param) {
        $this->load->language('');
        $menu = array();

        $item = array('caption'=> $this->language->get('home'));
        $item = array('link'=> $this->response->url('home'));
        $item = array('active'=> 0);
        $menu[] = $item;
        
        $item = array('caption'=> $this->language->get('home'));
        $item = array('link'=> $this->response->url('home'));
        $item = array('active'=> 0);
        $menu[] = $item;

        $item = array('caption'=> $this->language->get('home'));
        $item = array('link'=> $this->response->url('home'));
        $item = array('active'=> 0);
        $menu[] = $item;

        $item = array('caption'=> $this->language->get('about'));
        $item = array('link'=> $this->response->url('about'));
        $item = array('active'=> 0);
        $menu[] = $item;       
        
        $item = array('caption'=> $this->language->get('customers'));
        $item = array('link'=> $this->response->url('customeroffice'));
        $item = array('active'=> 0);
        $menu[] = $item;       

        $item = array('caption'=> $this->language->get('masters'));
        $item = array('link'=> $this->response->url('masteroffice'));
        $item = array('active'=> 0);
        $menu[] = $item;               
      
        $item = array('caption'=> $this->language->get('support'));
        $item = array('link'=> $this->response->url('support'));
        $item = array('active'=> 0);
        $menu[] = $item;               
        
        $data['menu'] = $menu;
        
        return $this->load->view('common/menu', $menu);
    }
}
