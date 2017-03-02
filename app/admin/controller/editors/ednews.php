<?php
class ControllerEditorsEdnews extends Controller {
    public function index($succ_warn = array()) {
        $this->load->language('editors/news');
        $this->load->model('editors');
        $data = array();
        $data['news_data'] = $this->model_editors->getNews();
        //=======================================
        $data['control_title'] = $this->language->get('control_title');
        $data['yes'] = $this->language->get('yes');
        $data['no'] = $this->language->get('no');
        $data['new_article_title'] = $this->language->get('new_article_title');
        $data['del_article_title'] = $this->language->get('del_article_title');  
        $data['edit_article_title'] = $this->language->get('edit_article_title'); 
        $data['btn_save'] = $this->language->get('btn_save');
        $data['btn_cancel'] = $this->language->get('btn_cancel');
        $data['btn_delete'] = $this->language->get('btn_delete');   
        $data['chb_archive'] = $this->language->get('chb_archive');
        $data['del_question'] = $this->language->get('del_question');
        //=======================================
        $data['fld_id'] = $this->language->get('fld_id');
        $data['fld_title'] = $this->language->get('fld_title');
        $data['fld_article'] = $this->language->get('fld_article');
        $data['fld_added'] = $this->language->get('fld_added');
        $data['fld_archive'] = $this->language->get('fld_archive');
        $data['action'] = $this->response->url('panels/news/act_dispatch');
        $data['succ_warn'] = $succ_warn;
        $data['success_msg'] = $this->language->get('success_msg');
        $data['success_del_msg'] = $this->language->get('success_del_msg');
        
        return $this->load->view('editors/news_editform', $data);        
    }
}
