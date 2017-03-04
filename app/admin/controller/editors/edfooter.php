<?php
class ControllerEditorsEdfooter extends Controller {
    public function index($succ_warn = array()) {
        $this->load->language('editors/footer');
        $this->load->model('editors');
        $data = array();
        $data['news_data'] = $this->model_editors->getNews();
        //=======================================
        $data['control_title'] = $this->language->get('control_title');
        $data['first_tab_title'] = $this->language->get('first_tab_title');
        $data['second_tab_title'] = $this->language->get('second_tab_title');
        $data['third_tab_title'] = $this->language->get('third_tab_title');
        $data['editor_title'] = $this->language->get('editor_title');  
        $data['preview_title'] = $this->language->get('preview_title'); 
        $data['btn_save'] = $this->language->get('btn_save');
        $data['action'] = $this->response->url('panels/news/save');
        $data['succ_warn'] = $succ_warn;
        $data['success_msg'] = $this->language->get('success_msg');
        $data['curr_tab'] = 'first';
        if(isset($this->session->data['curr_footer_edit_tab'])){
            $data['curr_tab'] = $this->session->data['curr_footer_edit_tab'];
            unset($this->session->data['curr_footer_edit_tab']);
        }
        
        return $this->load->view('editors/footer_editform', $data);        
    }
}
