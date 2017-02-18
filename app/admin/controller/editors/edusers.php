<?php
class ControllerEditorsEdusers extends Controller {
    public function index() {
        $this->load->language('editors/users');
        $this->load->model('editors');
        $data = array();
        $data['users_data'] = $this->model_editors->getUsers();
        //=======================================
        $data['control_title'] = $this->language->get('control_title');
        $data['users_tab_title'] = $this->language->get('users_tab_title');
        $data['groups_tab_title'] = $this->language->get('groups_tab_title');
        $data['gid_field_title'] = $this->language->get('gid_field_title');
        $data['gname_field_title'] = $this->language->get('gname_field_title');
        $data['lang_not_selected'] = $this->language->get('lang_not_selected');
        $data['yes'] = $this->language->get('yes');
        $data['no'] = $this->language->get('no');
        //=======================================
        $data['uid_field_title'] = $this->language->get('uid_field_title');
        $data['ufirstname_field_title'] = $this->language->get('ufirstname_field_title');
        $data['upatronymic_field_title'] = $this->language->get('upatronymic_field_title');
        $data['ulastname_field_title'] = $this->language->get('ulastname_field_title');
        $data['ulogim_field_title'] = $this->language->get('ulogim_field_title');
        $data['upwd_field_title'] = $this->language->get('upwd_field_title');
        $data['uemail_field_title'] = $this->language->get('uemail_field_title');
        $data['ugroup_field_title'] = $this->language->get('ugroup_field_title');
        $data['uactive_field_title'] = $this->language->get('uactive_field_title');
        $data['usessionid_field_title'] = $this->language->get('usessionid_field_title');
        $data['ulanguage_field_title'] = $this->language->get('ulanguage_field_title');
        $data['uregexpired_field_title'] = $this->language->get('uregexpired_field_title');
        return $this->load->view('editors/users_editform', $data);
    }
}
