<?php
class ModelUserdata extends Model {
    private function getLog($task_id) {
        $sql = 'SELECT ' 
                .'`log`.*, ' 
                .'`auth`.`first_name` as `auth_first_name`, '
                .'`auth`.`last_name` as `auth_last_name`, '
                .'`reciv`.`first_name` as `reciv_first_name`, '
                .'`reciv`.`last_name` as `reciv_last_name` '
                .'FROM `'.DB_PREFIX.'order_log` as `log` '
                .'LEFT JOIN `'.DB_PREFIX.'users` as `auth` ON `log`.`post_author` = `auth`.`id` '
                .'LEFT JOIN `'.DB_PREFIX.'users` as `reciv` ON `log`.`post_reciver` = `reciv`.`id` '
                .'WHERE `log`.`oreder_id` = '.$task_id
                .'ORDER BY `log`.`id`, `log`.`parent_post`, `log`.`post_stamp`';
        $res = $this->db->sql($sql);
        if(!$res['rows_count']){
            return NULL;
        }
        
        $logs = array();
        foreach ($res as $task) {
            HERE
        }
    }
    
    private function getCustomerData() {
        //User data consist of tasks
        $tasks = array();
        
        $sql = 'SELECT `tsk`.*, `dev`.* '
            . 'FROM `service`.`'.DB_PREFIX.'task` as tsk ' 
            .'LEFT JOIN `service`.`'.DB_PREFIX.'device` as dev '
            .'ON tsk.device_id = dev.id '
            .'WHERE tsk.customer_id = '.$this->user->getID();
        $res = $this->db-sql($sql);
        
        if($res['rows_count'] == 0){
            //it's very strange
            return NULL;
        }
        
        foreach ($res['rows'] as $curr_row){
            $task = array();
            $device = array();
            
            $device['id'] = $res['device_id'];
            $device['serial'] = $res['serial'];
            $device['type'] = $res['devicetype'];
            $device['brand'] = $res['brand'];
            $device['model'] = $res['model'];
            
            $task['id'] = $res['idorder'];
            $task['start'] = $res['start_date'];
            $task['finish'] = $res['close_date'];
            $task['device'] = $device;
            $task['cond'] = $res['device_condition'];
            $task['complaint'] = $res['complaint'];
            $task['complect'] = $res['completeness'];
            $task['id'] = $res['id'];
            
            $tasks[] = $task;
        }
        
        foreach ($tasks as $index => $task) {
            $log = $this->getLog($task['id']);
            $tasks[$index]['log'] = $log;
        }
    }
    
    private function getMasterData() {
        
    }

    public function getUserData() {
        if(!$this->user->isLoggedIn()){
            return NULL;
        }
        
        if($this->user->isCustomer()){
            return getCustomerData();
        }
        
        if($this->user->isMaster()){
            return getMasterData();
        }
        
    }
}
