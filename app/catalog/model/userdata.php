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
                .' ORDER BY `log`.`id`, `log`.`parent_post`, `log`.`post_stamp`';
        $res = $this->db->sql($sql);
        if(!$res['rows_count']){
            return NULL;
        }
        
        $logs = array();
        foreach ($res['rows'] as $task) {
            $curr_log = array();
            $curr_log['id'] = $task['id'];          
            $curr_log['date'] = $task['post_stamp'];
            $curr_log['author'] = $task['auth_first_name'].' '.$task['auth_last_name'];
            $curr_log['reciver'] = $task['reciv_first_name'].' '.$task['reciv_last_name'];
            $curr_log['parent_id'] = $task['parent_post'];  
            $curr_log['title'] = $task['post_title'];
            $curr_log['post'] = $task['post_content'];
            $curr_log['subposts'] = array();
            if($curr_log['parent_id'] === '0'){
                //Post by it's own
                $logs[$curr_log['id']] = $curr_log;
            }else{
                $logs[$curr_log['parent_id']]['subposts'] = $curr_log;
            }
            
            
        }
        return $logs;
    }
    
    private function getCustomerData() {
        //User data consist of tasks
        $tasks = array();
        
        $sql = 'SELECT `tsk`.*, `dev`.* '
            . 'FROM `service`.`'.DB_PREFIX.'task` as tsk ' 
            .'LEFT JOIN `service`.`'.DB_PREFIX.'device` as dev '
            .'ON tsk.device_id = dev.id '
            .'WHERE tsk.customer_id = '.$this->user->getID();
        $res = $this->db->sql($sql);
        
        if($res['rows_count'] == 0){
            //it's very strange
            return NULL;
        }
        
        foreach ($res['rows'] as $curr_row){
            $task = array();
            $device = array();
            
            $device['id'] = $curr_row['device_id'];
            $device['serial'] = $curr_row['serial'];
            $device['type'] = $curr_row['devicetype'];
            $device['brand'] = $curr_row['brand'];
            $device['model'] = $curr_row['model'];
            
            $task['id'] = $curr_row['idorder'];
            $task['start'] = $curr_row['start_date'];
            $task['finish'] = $curr_row['close_date'];
            $task['device'] = $device;
            $task['cond'] = $curr_row['device_condition'];
            $task['complaint'] = $curr_row['complaint'];
            $task['complect'] = $curr_row['completeness'];
            $task['id'] = $curr_row['id'];
            
            $tasks[] = $task;
        }
        
        foreach ($tasks as $index => $task) {
            $log = $this->getLog($task['id']);
            $tasks[$index]['log'] = $log;
        }
        
        return $tasks;
    }
    
    private function getMasterData() {
        
    }

    public function getUserData() {
        if(!$this->user->isLoggedIn()){
            return NULL;
        }
        
        if($this->user->isCustomer()){
            return $this->getCustomerData();
        }
        
        if($this->user->isMaster()){
            return $this->getMasterData();
        }
        
    }
}
