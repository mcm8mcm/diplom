<?php
class ControllerTaskrenderTheTask {
    public function index($task) {
        ddd($task);
        $this->load->language('taskrender/the_task');
        $device = $this->load->controller('taskrender/device_renderer', $task['device']);        
        $order = $this->load->controller('taskrender/order_renderer', $task);        
        $log = $this->load->controller('taskrender/log_renderer', $task['log']); 
        
    }
}
