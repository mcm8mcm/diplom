<?php
class ControllerCommonSidebar extends Controller {
    public function index() {
        $this->load->language('common/sidebar');
        $items = array();
        $item = array();
        $item['title'] = $this->language->get('opt_users');
        $item['href'] = $this->response->url('panels/users');
        $item['active'] = FALSE;
        $items[] = $item;
        
        $item['title'] = $this->language->get('opt_tasks');
        $item['href'] = $this->response->url('panels/tasks');
        $item['active'] = FALSE;
        $items[] = $item;
        
        $item['title'] = $this->language->get('opt_language');
        $item['href'] = $this->response->url('panels/language');
        $item['active'] = FALSE;
        $items[] = $item;
     
        $item['title'] = $this->language->get('opt_news');
        $item['href'] = $this->response->url('panels/news');
        $item['active'] = FALSE;
        $items[] = $item;
        
        $item['title'] = $this->language->get('opt_footer');
        $item['href'] = $this->response->url('panels/footer');
        $item['active'] = FALSE;
        $items[] = $item;
        
        $data['items'] = $items;
        return $this->load->view('common/sidebar', $data);     
    }
}
