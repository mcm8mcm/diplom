<?php
class ControllerTaskrenderOrderRenderer extends Controller {
    public function index($data) {
        $this->load->language('taskrender/order_renderer');
        $order_data = array();
        $order_data['order_title'] = $this->language->get('order_title');
        $order_data['order_header_title'] = $this->language->get('order_header_title');
        $order_data['order_customer_title'] = $this->language->get('order_customer_title');
        $order_data['order_master_title'] = $this->language->get('order_master_title');
        $order_data['order_startdate_title'] = $this->language->get('order_startdate_title');
        $order_data['order_finishdate_title'] = $this->language->get('order_finishdate_title');
        
        $order_data['task_id'] = $data['id'];
        $tmp_date = new DateTime();
        $tmp_date = $tmp_date->createFromFormat('Y-m-d', $data['start']);        
        $order_data['start_date'] = $tmp_date->format('d.m.Y');
        
        if($data['finish'] === NULL){
            $order_data['finish_date'] = 'IN PROCESS';
        } else {
            $tmp_date = $tmp_date->createFromFormat('Y-m-d', $data['finish']);        
            $order_data['finish_date'] = $tmp_date->format('d.m.Y');
        }

        $order_data['customer_id'] = $data['customer']['id'];
        $order_data['customer_name'] = $data['customer']['full_name'];  
        $order_data['master_id'] = $data['master']['id'];
        $order_data['master_name'] = $data['master']['full_name'];
        $order_data['device_view'] = $data['device_view'];
        $order_data['log_view'] = $data['log_view'];
        return $this->load->view('taskrender/order', $order_data);
    }
}
