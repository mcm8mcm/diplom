<?php
class ControllerCustomeroffice extends Controller {
    
    private $curr_action = '';
    
    private function getLogItem($log) {
        $posts = '';
        foreach ($log as $curr_log){
            $str_month = $this->language->get('month_3');
            $curr_date = date_create_from_format('Y-m-d H:i:s', $curr_log['date']);
            $data = array();
            $data['id'] = $curr_log['id'];
            $data['day_nom'] = date_format($curr_date, 'm');
            $data['month_nam'] = $str_month[date_format($curr_date, 'm')];
            $data['full_year'] = date_format($curr_date, 'Y');
            $data['from'] = $curr_log['author'];
            $data['to'] = $curr_log['reciver'];
            $data['from_id'] = $curr_log['author_id'];
            $data['to_id'] = $curr_log['reciver_id'];
            $data['order_id'] = $curr_log['order_id'];            
            $data['post_title'] = $curr_log['title'];
            $data['post_content'] = $curr_log['post'];
            $data['caption_from'] = $this->language->get('caption_from');
            $data['caption_to'] = $this->language->get('caption_to');
            $data['caption_title'] = $this->language->get('caption_title');
            $data['subposts'] = '';
            if(count($curr_log['subposts'])){
                $data['subposts'] = $this->getLogItem($curr_log['subposts']);
            }
            $posts .= $this->load->view('log_post', $data); 
            
        }
        return $posts;
    }
    
    private function getTasks($closed, $data){
        $content = '';
        foreach($data as $key=>$task){
            if($key === 'counter') break;
            $data = array();
            $create_date = date_create_from_format('Y-m-d', $task['start']);
            $data['title'] = $this->language->get('caption_task_title').$task['id'].$this->language->get('caption_task_date').$create_date->format('d.m.Y');
            $data['device_title'] = $this->language->get('caption_device');
            $data['params'][] = array($this->language->get('device_type'), $task['device']['type']);
            $data['params'][] = array($this->language->get('device_brand'), $task['device']['brand']);
            $data['params'][] = array($this->language->get('device_model'), $task['device']['model']);
            $data['params'][] = array($this->language->get('device_serial'), $task['device']['serial']);
            $data['caption_task_log'] = $this->language->get('caption_task_log');
            $data['log'] = $this->getLogItem($task['log']);
            $content = $this->load->view('task', $data).PHP_EOL;
        }
        return $content;
    }
    
    private function login() {
        $this->load->language('auth/customer_login');
        $sidebar = '';
        $menu = $this->load->controller('common/menu');        
        $header = $this->load->controller('common/header',$menu);
        
        $footer = $this->load->controller('common/footer');
        
        $data['header'] = $header;
        $data['menu'] = $menu;
        $data['sidebar'] = $sidebar;
        $data['footer'] = $footer;

        $form_data['form_title'] = $this->language->get('form_title');
        $form_data['login_title'] = $this->language->get('login_title');
        $form_data['password_title'] = $this->language->get('password_title');
        $form_data['redirect'] = $this->response->url('customeroffice');
        $form_data['action'] = $this->response->url('auth/login');
        $form_data['submit_title'] = $this->language->get('submit_title');
        $form_data['warning'] = '';
        if(isset($this->session->data['login_fail'])){
            unset($this->session->data['login_fail']);
            $form_data['warning'] = $this->language->get('warning');
        }
        
        $content = $this->load->view('auth/login', $form_data);
        $data['content'] = $content;
        
        
        $body = $this->load->view('home', $data);
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();         
    }

    public function index() {
        if(!$this->user->isLoggedIn()){
            $this->login();
            return;
        }        
        
        $sidebar = $this->load->controller('common/sidebar');
        $menu = $this->load->controller('common/menu');        
        $header = $this->load->controller('common/header',$menu);
        
        $footer = $this->load->controller('common/footer');
        
        $data['header'] = $header;
        $data['menu'] = $menu;
        $data['sidebar'] = $sidebar;
        $data['footer'] = $footer;

        //Make menu
        $this->load->language('customeroffice');
        $this->load->language('common/common');
        
        $cust_menu = array();
        $cust_menu[] = array('item_caption'=>$this->language->get('option_orders_in_progress'), 'cative'=>FALSE, 'link'=> $this->response->url('customeroffice/inprogress',''));
        $cust_menu[] = array('item_caption'=>$this->language->get('option_closed_orders'), 'cative'=>FALSE, 'link'=> $this->response->url('customeroffice/closed',''));
        $cust_menu[] = array('item_caption'=>$this->language->get('option_support'), 'cative'=>FALSE, 'link'=> $this->response->url('customeroffice/support',''));
        
        $this->load->model('userdata');
        $customer_data = $this->model_userdata->getUserData();
        //ddd($customer_data);
        $customer_data['counter'] = $this->counter($customer_data);
        
        $tmp_data = array();
        $tmp_data['inprogress_link'] = $customer_data['counter']['active'] != 0 ? $this->response->url('customeroffice/inprogress') : $this->response->url('customeroffice');
        $tmp_data['closed_link'] = $customer_data['counter']['closed'] != 0 ? $this->response->url('customeroffice/closed') : $this->response->url('customeroffice');
        $tmp_data['inprogress'] = $this->language->get('option_orders_in_progress');
        $tmp_data['closed'] = $this->language->get('option_closed_orders');
        $tmp_data['active_count'] = $customer_data['counter']['active'];
        $tmp_data['closed_count'] = $customer_data['counter']['closed'];
        
        if($this->curr_action == ''){
            $tmp_data['content'] = $this->language->get('choose_prompt');
        }elseif ($this->curr_action == 'inprogress') {
            $tmp_data['content'] = $this->getTasks($closed = FALSE, $customer_data);
        }elseif ($this->curr_action == 'closed') {
            $tmp_data['content'] = $this->getTasks($closed = TRUE, $customer_data);
        }
        
        if($tmp_data['active_count'] == 0 && $tmp_data['closed_count'] == 0){
            $tmp_data['content'] = $this->language->get('no_content');
        }
        
        $content = $this->load->view('customerofficecontent',$tmp_data);
        
        $edit_form_data = array();
        $edit_form_data['action'] = $tmp_data['inprogress_link'];
        $edit_form_data['title'] = $this->language->get('edit_title_caption');
        $edit_form_data['content'] = $this->language->get('edit_content_caption');
        $edit_form_data['cancle_btn'] = $this->language->get('edit_cancel_caption');
        $edit_form_data['save_btn'] = $this->language->get('edit_save_caption');
        $edit_form = $this->load->view('post_edit_form', $edit_form_data);
        
        $data['content'] = $edit_form . PHP_EOL . $content;
               
        $body = $this->load->view('home', $data);
        
        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);
        
        $this->response->setOutput($this->document->render());
        $this->response->flush();          
    }
    
    private function counter($tasks) {
        $ret = array('active'=>0,'closed'=>0);
        
        foreach ($tasks as $task) {
            if($task['finish'] === NULL){
                $ret['active'] += 1;
            } else {
                $ret['closed'] += 1;
            }
        }
        
        return $ret;
    }
    
    public function inprogress() {
        $this->curr_action = 'inprogress';
        //ddd($this->request->post);
        if(isset($this->request->post['post_date'])){
            $this->load->model('userdata');
            $data = array();
            foreach ($this->request->post as $key => $value) {
                $data[$key] = $value;
            }
            
            $this->model_userdata->addPost($data);
        }
        $this->index();
    }

    public function closed() {
        $this->curr_action = 'closed';
        $this->index();
    }

    public function support() {
        
    }

    
}
