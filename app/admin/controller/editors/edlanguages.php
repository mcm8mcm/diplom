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
        //=======================================
        $data['lname'] = $this->language->get('uid_field_title');
        $data['lshort_name'] = $this->language->get('ufirstname_field_title');
        $data['currency_name'] = $this->language->get('upatronymic_field_title');
        $data['lflag'] = $this->language->get('ulastname_field_title');
        $data['lactive'] = $this->language->get('ulogim_field_title');
        $data['ldesc'] = $this->language->get('upwd_field_title');
        $data['new_lang_title'] = $this->language->get('new_user_title');        
        $data['action'] = $this->response->url('panels/languages/edit');
        $data['add_action'] = $this->response->url('panels/languages/add_language');
        $data['succ_warn'] = $succ_warn;
        $data['success_msg'] = $this->language->get('success_msg');
        return $this->load->view('editors/language_editform', $data);
    }   
}