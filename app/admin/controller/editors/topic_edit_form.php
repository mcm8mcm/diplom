<?php

class ControllerEditorsTopicEditForm extends Controller {

    public function index($params) {
        $this->load->language('editors/topic_edit_form');
        $data = array();
        $data['form_title'] = $this->language->get('form_title');
        $data['parent_topic_title'] = $this->language->get('parent_topic_title');
        $data['parent_not_selected'] = $this->language->get('parent_not_selected');
        $data['title_from'] = $this->language->get('title_from');
        $data['title_to'] = $this->language->get('title_to');
        $data['topic_date_title'] = $this->language->get('topic_date_title');
        $data['topic_subject_title'] = $this->language->get('topic_subject_title');
        $data['topic_content_title'] = $this->language->get('topic_content_title');
        $this->load->model('editors');
        //ddd();
        $d = $this->model_editors->getTopicToEdit($this->request->post['topic_id']);
        ddd($d);
        $data['parent_topic'] = 'Parent topic not selected';
        $data['topic_date'] = '30.03.2017 12:10:22';
        $data['topic_from'] = '';
        
        return $this->load->view('editors/topic_edit_form', $data);
    }
}
