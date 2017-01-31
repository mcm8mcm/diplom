<?php
class ControllerCustomeroffice extends Controller {
    
    private $curr_action = '';
    
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
        
        $customer_data['counter'] = $this->counter($customer_data);
        
        $tmp_data = array();
        $tmp_data['inprogress_link'] = $customer_data['counter']['active'] != 0 ? $this->response->url('customeroffice/inprogress') : $this->response->url('customeroffice');
        $tmp_data['closed_link'] = $customer_data['counter']['closed'] != 0 ? $this->response->url('customeroffice/closed') : $this->response->url('customeroffice');
        $tmp_data['inprogress'] = $this->language->get('option_orders_in_progress');
        $tmp_data['closed'] = $this->language->get('option_closed_orders');
        $tmp_data['active_count'] = $customer_data['counter']['active'];
        $tmp_data['closed_count'] = $customer_data['counter']['closed'];
        //ddd($customer_data);
        
        $content = $this->load->view('customerofficecontent',$tmp_data);
        $data['content'] = $content;
               
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
    }

    public function closed() {
        $this->curr_action = 'closed';
    }

    public function support() {
        
    }

    
}
