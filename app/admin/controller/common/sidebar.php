<?php
class ControllerCommonSidebar extends Controller {
    public function index() {
        if(!isset($this->session->data['link'])){
            $this->session->data['link'] = '/panels/users';
        }
        
        $this->load->language('common/sidebar');
        $items = array();
        $item = array();
        $item['title'] = $this->language->get('opt_users');
        $item['href'] = $this->response->url('panels/users');
        $item['active'] = strpos($this->session->data['link'], 'panels/users');
        $items[] = $item;
        
        $item['title'] = $this->language->get('opt_tasks');
        $item['href'] = $this->response->url('panels/tasks');
        $item['active'] = strpos($this->session->data['link'], 'panels/tasks');
        $items[] = $item;
        
        $item['title'] = $this->language->get('opt_language');
        $item['href'] = $this->response->url('panels/language');
        $item['active'] = strpos($this->session->data['link'], 'panels/language');
        $items[] = $item;
     
        $item['title'] = $this->language->get('opt_news');
        $item['href'] = $this->response->url('panels/news');
        $item['active'] = strpos($this->session->data['link'], 'panels/news');
        $items[] = $item;
        
        $item['title'] = $this->language->get('opt_footer');
        $item['href'] = $this->response->url('panels/footer');
        $item['active'] = strpos($this->session->data['link'], 'panels/footer');
        $items[] = $item;
        
        $data['items'] = $items;
        return $this->load->view('common/sidebar', $data);     
    }
}
