<?php
class ControllerCommonSidebar extends Controller {
    public function index() {
        $this->load->language('common/sidebar');
        $this->load->model('news');
        $data['news'] = $this->model_news->getNews();
        return $this->load->view('common/sidebar', $data);     
    }
}
