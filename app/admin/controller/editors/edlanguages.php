<?php
class ControllerEditorsEdlanguages extends Controller {
    public function index($succ_warn = array()) {
        $this->load->language('editors/languages');
        $this->load->model('editors');
        $data = array();
        $data['lang_data'] = $this->model_editors->getLanguages();
        $data['lang_flags'] = $this->model_editors->getFlags();
        //=======================================
        $data['control_title'] = $this->language->get('control_title');
        $data['yes'] = $this->language->get('yes');
        $data['no'] = $this->language->get('no');
        $data['del_lang_title'] = $this->language->get('del_lang_title');
        $data['edit_lang_title'] = $this->language->get('edit_lang_title');  
        $data['btn_save'] = $this->language->get('btn_save');
        $data['btn_cancel'] = $this->language->get('btn_cancel');
        $data['del_question'] = $this->language->get('del_question');
        //=======================================
        $data['lname'] = $this->language->get('lname');
        $data['lshort_name'] = $this->language->get('lshort_name');
        $data['currency_name'] = $this->language->get('currency_name');
        $data['lflag'] = $this->language->get('lflag');
        $data['lactive'] = $this->language->get('lactive');
        $data['ldesc'] = $this->language->get('ldesc');
        $data['new_lang_title'] = $this->language->get('new_lang_title'); 
        $data['edit_action'] = $this->response->url('panels/language/edit');
        $data['add_action'] = $this->response->url('panels/language/add_language');
        $data['del_action'] = $this->response->url('panels/language/del_language');        
        $data['succ_warn'] = $succ_warn;
        $data['success_msg'] = $this->language->get('success_msg');
        $data['success_del_msg'] = $this->language->get('success_del_msg');
        
        return $this->load->view('editors/language_editform', $data);
    }   
}