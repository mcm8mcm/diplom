<?php
class ControllerTaskrenderTheTask extends Controller {
    public function index($task) {
        $this->load->language('taskrender/the_task');
        $device_data = $task['device'];
        $device_data['condition'] = $task['cond'];
        $device_data['complaint'] = $task['complaint'];
        $device_data['complect'] = $task['complect'];
        
        $device = $this->load->controller('taskrender/device_renderer', $device_data); 
        return $device;
        $order = $this->load->controller('taskrender/order_renderer', $task);        
        $log = $this->load->controller('taskrender/log_renderer', $task['log']); 
        
    }
}
