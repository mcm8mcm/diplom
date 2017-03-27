<?php
class ControllerTaskrenderTheTask extends Controller {
    public function index($task) {
        $this->load->language('taskrender/the_task');
        $device_data = $task[0]['device'];
        $device_data['condition'] = $task[0]['cond'];
        $device_data['complaint'] = $task[0]['complaint'];
        $device_data['complect'] = $task[0]['complect'];
        $device_data['back_link'] = $task[1]['back_link'];
        
        $device = $this->load->controller('taskrender/device_renderer', $device_data); 
        $task[0]['device_view'] = $device;
        $log = $this->load->controller('taskrender/log_renderer', array($task[0]['log'], $task[1])); 
        $task[0]['log_view'] = $log;
        $order = $this->load->controller('taskrender/order_renderer', $task[0]);   
        return $order;
    }
}
