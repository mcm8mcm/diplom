<?php
class ControllerTaskrenderLogRenderer extends Controller {
    private function getDateView($curr_date) {
        $tmp_date = date_create_from_format('Y-m-d H:i:s', $curr_date);    
        return array('date' => $tmp_date->format('d.m.Y'), 'time' => $tmp_date->format('h:i:s'));
    } 
    
    private function getLogView($log, $back_link) {
        $add = $log[1];
        $log = $log[0];
        
        $log_posts = array();
        if(!count($log)){;
            return '';
        }
        
        $data = array();
        $data['from_title'] = $this->language->get('from_title');
        $data['to_title'] = $this->language->get('to_title');
        $data['post_title_title'] = $this->language->get('post_title_title');
        $data['post_content_title'] = $this->language->get('post_content_title');        
        
        foreach ($log as $curr_log){
            $data['post_id'] = $curr_log['id'];
            $data = array_merge($data, $this->getDateView($curr_log['date'])); 
            $data['author_id'] = $curr_log['author_id'];
            $data['author'] = $curr_log['author'];
            $data['reciver_id'] = $curr_log['reciver_id'];
            $data['reciver'] = $curr_log['reciver'];
            $data['parent_id'] = $curr_log['parent_id'];
            $data['title'] = $curr_log['title'];
            $data['post_content'] = $curr_log['post'];
            $data['subposts'] = array();
            $data['edit_link'] = $this->response->url('panels/tasks');         
            $data['user_id'] = $add['user_id'];  
            $data['back_link'] = $back_link;
            $data['subposts'] = $this->getLogView(array($curr_log['subposts'], $add), $back_link);
            $log_posts[] = $this->load->view('taskrender/log', $data);
        }
        return $log_posts;
    }

    public function index($log) {
        //Index is not stand alone in this context
        //$log is required
        $this->load->language('taskrender/log_renderer');
        
        $log_list = $this->getLogView($log, $log[1]['back_link']);
        $data = array();
        $log = (array)$log;
        $log_list = (array)$log_list;
        $data['log_list'] = $log_list;
        $data['log_title'] = $this->language->get('log_title');
        $data['order_id'] = count($log[0]) ? $log[0][0]['order_id'] : '';
        return $this->load->view('taskrender/logs', $data);
    }
}
