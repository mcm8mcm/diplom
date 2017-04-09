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
        $data['item_not_selected'] = $this->language->get('item_not_selected');
        $data['save_title'] = $this->language->get('save_topic');
        $data['cancel_title'] = $this->language->get('cancel_topic');
        
        $this->load->model('editors');
        $post_data = $this->model_editors->getTopicToEdit($this->request->post['topic_id']);
        //ddd($post_data);  
        $data['parent_topic'] = 'Parent topic not selected';
        $data['topic_date'] = $post_data['post_stamp']['date'].' '.$post_data['post_stamp']['time'];//'30.03.2017 12:10:22';
        $data['topic_from_id'] = $post_data['post_author']['id'];
        $data['topic_from_name'] = $post_data['post_author']['name'];
        $data['topic_to_id'] = $post_data['post_reciver']['id'];
        $data['topic_to_name'] = $post_data['post_reciver']['name'];
        $data['topic_title'] = $post_data['post_title'];
        $data['topic_content'] = $post_data['post_content'];
        
        
        $data['users'] = $post_data['users'];     
        return $this->load->view('editors/topic_edit_form', $data);
    }
}
