<?php
class ControllerTaskrenderTheTask {
    public function index($task) {
        $this->load->language('taskrender/the_task');
        $order = $this->load->controller('taskrender/order_renderer', $task);        
        $device = $this->load->controller('taskrender/device_renderer', $task);
        $log = $this->load->controller('taskrender/log_renderer', $task);        
    }
}
