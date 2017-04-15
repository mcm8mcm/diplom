<?php
class ControllerEditorsEdtasks extends Controller {
    public function index($succ_warn = array()) {
        $this->load->language('editors/tasks');
        $this->load->model('editors');
        $data = array();
        $this->load->model('editors'); 
        $data['control_title'] = $this->language->get('control_title');
        $data['editor_title'] = $this->language->get('editor_title');  
        $data['succ_warn'] = $succ_warn;
        $data['success_msg'] = $this->language->get('success_msg');
        if(isset($this->session->data['curr_footer_edit_tab'])){
            $data['curr_tab'] = $this->session->data['curr_footer_edit_tab'];
            unset($this->session->data['curr_footer_edit_tab']);
        }
        
        
        $data['user_list'] = $this->load->controller("editors/user_list");
        
        if(!isset($this->request->post['edit_action'])){
            $data['task_list'] = $this->load->controller("editors/task_list");
        }else{
            $edit_form_data = array();
            $edit_form_data['action'] = $this->request->post['edit_action'];
            $edit_form_data['user_id'] = $this->request->post['user_id'];
            $edit_form_data['topic_id'] = $this->request->post['topic_id']; 
            $edit_form_data['back_link'] = $this->request->post['back_link'];           
            $data['task_list'] = $this->load->controller("editors/topic_edit_form", $edit_form_data);
        }
        
        
        return $this->load->view('editors/tasks_editform', $data);        
    }
}
