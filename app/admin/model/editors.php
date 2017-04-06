<?php

class ModelEditors extends Model {
    private function getDateView($curr_date) {
        $tmp_date = date_create_from_format('Y-m-d H:i:s', $curr_date);    
        return array('date' => $tmp_date->format('d.m.Y'), 'time' => $tmp_date->format('h:i:s'));
    } 
    
    public function getUserGroups() {
        $sql = 'SELECT * FROM `' . DB_PREFIX . 'user_group`';
        $res = $this->db->sql($sql);
        return $res['rows'];
    }

    public function getUsers($users_only=FALSE) {
        $sql = 'SELECT `u`.*, '
                . '`ugroup`.`name` as `group_name` '
                . 'FROM `' . DB_PREFIX . 'users` AS `u` LEFT JOIN `'
                . DB_PREFIX . 'user_group`  AS `ugroup` ON `u`.`group` = `ugroup`.`id`';

        $users = array();
        $res = $this->db->sql($sql);
        $users = $res['rows'];
        if($users_only){
            return $users;
        }
        
        $groups = array();
        $groups = $this->getUserGroups();
        $lang = $this->getLanguages();
        return array('user' => $users, 'groups' => $groups, 'lang' => $lang);
    }

    public function getNews() {
        $sql = 'SELECT * FROM `' . DB_PREFIX . 'news`';
        $res = $this->db->sql($sql);
        return $res['rows'];
    }

    public function addArticle($data) {
        $sql = "INSERT INTO `" . DB_PREFIX . "news`(`title`,`article`,`added`,`archive`) "
                . "VALUES('" . $data['article_title'] . "',"
                . "'" . $data['article_content'] . "',"
                . "'" . $data['creation_date'] . "',"
                . $data['is_archive'] . ")";

        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString() . PHP_EOL . $sql;
        }

        return $toret;
    }

    public function editArticle($data) {
        $sql = "UPDATE `" . DB_PREFIX . "news` SET "
                . "`title` = '" . $data['article_title'] . "', "
                . "`article` = '" . $data['article_content'] . "', "
                . "`added` = '" . $data['creation_date'] . "', "
                . "`archive` = " . $data['is_archive'] . " "
                . "WHERE `id` = " . $data['art_id'];

        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString() . PHP_EOL . $sql;
        }

        return $toret;
    }

    public function deleteArticle($data) {
        $sql = "DELETE FROM `" . DB_PREFIX . "news` WHERE `id`=" . $data['art_id'];
        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString();
        }

        return $toret;
    }

    public function getFooterData($data) {
        $filename = DIR_DOWNLOAD . 'footers' . DS . $data . '_footer_template.html';

        if (!is_file($filename)) {
            return '';
        }
        $content = file_get_contents($filename);
        return $content ? $content : '';
    }

    public function saveFooterData($data) {
        $filename = DIR_DOWNLOAD . 'footers' . DS . $data['zone'] . '_footer_template.html';

        $toret = array();
        try {
            $res = file_put_contents($filename, $data['content']);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString();
        }

        if (!$ret) {
            $toret['error'] = $ret;
        }

        return $toret;
    }

    public function getLanguages() {
        $sql = 'SELECT * FROM `' . DB_PREFIX . 'languages`';
        $res = $this->db->sql($sql);

        foreach ($res['rows'] as $key => $value) {

            if (!empty($value['flag'])) {
                $tmp = explode('/', $value['flag']);
                $flag = strtoupper(explode(".", $tmp[count($tmp) - 1])[0]);
                $res['rows'][$key]['flag_name'] = $flag;
            }
        }
        return($res['rows']);
    }

    public function addLanguage($data) {
        $sql = "INSERT INTO `" . DB_PREFIX . "languages` VALUES('" . $data['lang_name'] . "',"
                . "'" . $data['short_name'] . "',"
                . "'" . $data['currency'] . "',"
                . "'" . $data['flag'] . "',"
                . $data['is_active'] . ","
                . "'" . $data['description'] . "')";

        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString();
        }

        return $toret;
    }

    public function delLanguage($lang_id) {
        $sql = "UPDATE `" . DB_PREFIX . "users` SET `language`='' WHERE `language`='" . $lang_id . "'";
        $this->db->sql($sql);
        $sql = "DELETE FROM `" . DB_PREFIX . "languages` WHERE `name`='" . $lang_id . "'";
        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString();
        }

        return $toret;
    }

    public function editLanguage($data) {
        $old_name = $data['old_name'];
        $sql = "UPDATE `" . DB_PREFIX . "languages` SET "
                . "`name` = '" . $data['lang_name'] . "', "
                . "`short_name` = '" . $data['short_name'] . "', "
                . "`currency` = '" . $data['currency'] . "', "
                . "`active` = " . $data['is_active'] . ", "
                . "`flag` = '" . $data['flag'] . "', "
                . "`lang_word` = '" . $data['description'] . "' "
                . "WHERE `name` = '" . $old_name . "'";

        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString() . PHP_EOL . $sql;
        }

        return $toret;
    }

    public function getFlags() {
        $toret = array();
        $path = ICLUDE_URL . DS . 'img' . DS . 'flags';
        $files = scandir(APP_PATH . DS . $path);

        foreach ($files as $value) {
            if ($value === '.' || $value === '..')
                continue;
            $flag_name = strtoupper(explode('.', $value)[0]);
            $toret[] = array('path' => $path . DS . $value, 'name' => $flag_name);
        }

        return $toret;
    }

    /////////////////// TASKS //////////////////////////////
    public function getTopicToEdit($topic_id, $is_parent=FALSE) {
        $sql = 'SELECT '
                . '`log`.*, '
                . '`auth`.`id` as `auth_id`, '
                . '`reciv`.`id` as `reciv_id`, '
                . "CONCAT_WS(' ',`auth`.`first_name`, `auth`.`last_name`) as `auth_name`, "
                . "CONCAT_WS(' ', `reciv`.`first_name`, `reciv`.`last_name`) as `reciv_name` "
                . 'FROM `' . DB_PREFIX . 'order_log` as `log` '
                . 'LEFT JOIN `' . DB_PREFIX . 'users` as `auth` ON `log`.`post_author` = `auth`.`id` '
                . 'LEFT JOIN `' . DB_PREFIX . 'users` as `reciv` ON `log`.`post_reciver` = `reciv`.`id` '
                . 'WHERE `log`.`id` = ' . $topic_id
                . ' ORDER BY `log`.`post_stamp`, `log`.`parent_post`,`log`.`id` ';
        $res = $this->db->sql($sql);
        if (!$res['rows_count']) {
            $data = array();
            $data['id'] = '';
            $data['post_stamp'] = '';
            $data['post_author'] = array('id' => '', 'name' => '');
            $data['post_reciver'] = array('id' => '', 'name' => '');
            $data['post_title'] = '';
            $data['post_content'] = '';
            if (!$is_parent) {
                $data['parent_post'] = array();
            }
            
            return $data;
        }
        
        $data = array();
        $data['id'] = $res['row']['id'];
        $data['post_stamp'] = $this->getDateView($res['row']['post_stamp']);
        $data['post_author'] = array('id'=>$res['row']['post_author'], 'name'=>$res['row']['auth_name']);
        $data['post_reciver'] = array('id'=>$res['row']['post_reciver'], 'name'=>$res['row']['reciv_name']);
        $data['post_title'] = $res['row']['post_title'];
        $data['post_content'] = $res['row']['post_content'];
        if(!$is_parent){
            $data['parent_post'] = $this->getTopicToEdit($res['row']['parent_post'], TRUE); 
            $data['users'] = array();
            $users = $this->getUsers(TRUE);
            foreach ($users as $user){
                $data['users'][] = array('id'=>$user['id'], 'name'=>$user['first_name'].' '.$user['patronymic'].' '.$user['last_name']);
            }               
        } 
        
        return $data;
    }
    
    private function openLog($task) {
        $curr_log = array();
        $curr_log['id'] = $task['id'];
        $curr_log['order_id'] = $task['order_id'];
        $curr_log['date'] = $task['post_stamp'];
        $curr_log['author_id'] = $task['auth_id'];
        $curr_log['reciver_id'] = $task['reciv_id'];
        $curr_log['author'] = $task['auth_name'];
        $curr_log['reciver'] = $task['reciv_name'];
        $curr_log['parent_id'] = $task['parent_post'];
        $curr_log['title'] = $task['post_title'];
        $curr_log['post'] = $task['post_content'];
        $curr_log['subposts'] = array();
        return $curr_log;
    }

    private function addNode($parent_id, $data) {
        $to_ret = array();
        foreach ($data as $key => $value) {
            if ($value['parent_id'] === $parent_id) {
                if ($value['id'] !== '0') {
                    $value['subposts'] = $this->addNode($value['id'], $data);
                }
                $to_ret[] = $value;
            }
        }
        return $to_ret;
    }

    private function getLog($task_id) {
        $sql = 'SELECT '
                . '`log`.*, '
                . '`auth`.`id` as `auth_id`, '
                . '`reciv`.`id` as `reciv_id`, '
                . "CONCAT_WS(' ',`auth`.`first_name`, `auth`.`last_name`) as `auth_name`, "
                . "CONCAT_WS(' ', `reciv`.`first_name`, `reciv`.`last_name`) as `reciv_name` "
                . 'FROM `' . DB_PREFIX . 'order_log` as `log` '
                . 'LEFT JOIN `' . DB_PREFIX . 'users` as `auth` ON `log`.`post_author` = `auth`.`id` '
                . 'LEFT JOIN `' . DB_PREFIX . 'users` as `reciv` ON `log`.`post_reciver` = `reciv`.`id` '
                . 'WHERE `log`.`order_id` = ' . $task_id
                . ' ORDER BY `log`.`post_stamp`, `log`.`parent_post`,`log`.`id` ';
        $res = $this->db->sql($sql);
        if (!$res['rows_count']) {
            return NULL;
        }

        $logs = array();
        foreach ($res['rows'] as $task) {
            $logs[$task['id']] = $this->openLog($task);
            /*
              if($curr_log['parent_id'] === '0'){
              //Post by it's own
              $logs[$curr_log['id']] = $curr_log;
              }else{
              $logs[$curr_log['parent_id']]['subposts'][] = $curr_log;
              }
             */
        }

        $tree_log = array();

        foreach ($logs as $key => $value) {
            if ($value['parent_id'] === '0') {
                $value['subposts'] = $this->addNode($value['id'], $logs);
                $tree_log[] = $value;
            }
        }

        return $tree_log;
    }

    private function getCustomerData($user_id) {
        //User data consist of tasks
        $tasks = array();
        $sql = "SELECT `tsk`.*, `dev`.*, "
        ."`customers`.`id` AS `cust_id`, "
        ."CONCAT_WS(' ', `customers`.`first_name`, `customers`.`patronymic`, `customers`.`last_name`) AS `cust_name`, "
        ."`tab_master`.`id` AS `master_id`, "
        ."CONCAT_WS(' ', `tab_master`.`first_name`, `tab_master`.`patronymic`, `tab_master`.`last_name`) AS `master_name` "
        ."FROM `".DB_PREFIX."task` AS `tsk` " 
        ."LEFT JOIN `".DB_PREFIX."device` AS `dev` ON `tsk`.`device_id` = `dev`.`id` "
        ."LEFT JOIN `".DB_PREFIX."users` AS `customers` ON `tsk`.`customer_id` = `customers`.`id` "
        ."LEFT JOIN `".DB_PREFIX."users` AS `tab_master` ON `tsk`.`master_id` = `tab_master`.`id` "
        ."WHERE `customers`.`id` = ".$user_id." OR `tab_master`.`id` = ".$user_id;

        $res = $this->db->sql($sql);
        if ($res['rows_count'] == 0) {
            //it's very strange
            return NULL;
        }

        foreach ($res['rows'] as $curr_row) {
            $task = array();
            $device = array();
            $customer = array();
            $master = array();

            $device['id'] = $curr_row['device_id'];
            $device['serial'] = $curr_row['serial'];
            $device['type'] = $curr_row['devicetype'];
            $device['brand'] = $curr_row['brand'];
            $device['model'] = $curr_row['model'];
            
            $customer['id'] = $curr_row['cust_id'];
            $customer['full_name'] = $curr_row['cust_name'];
            
            $master['id'] = $curr_row['master_id'];
            $master['full_name'] = $curr_row['master_name'];
            
            $task['id'] = $curr_row['idorder'];
            $task['start'] = $curr_row['start_date'];
            $task['finish'] = $curr_row['close_date'];
            $task['device'] = $device;
            $task['customer'] = $customer;
            $task['master'] = $master;            
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

    public function getTasks($user_id) {
        return $this->getCustomerData($user_id);
    }

    /////////////////// TASKS //////////////////////////////

    public function postUser($data) {
        $groups = $this->getUserGroups();
        $group_id = '';
        foreach ($groups as $value) {
            if ($value['name'] === $data['user_group']) {
                $group_id = $value['id'];
                break;
            }
        }
        $sql = "UPDATE `" . DB_PREFIX . "users` SET "
                . "`first_name` = '" . $data['first_name'] . "', "
                . "`patronymic` = '" . $data['patronymic'] . "', "
                . "`last_name` = '" . $data['lastname'] . "', "
                . "`login` = '" . $data['login'] . "', "
                . "`pwd` = '" . $data['pwd'] . "', "
                . "`password` = '" . md5($data['pwd']) . "', "
                . "`email` = '" . $data['email'] . "', "
                . "`group` = " . $group_id . ", "
                . "`active` = " . $data['isactive'] . ", "
                . "`session_id` = '" . $data['cur_sess_id'] . "', "
                . "`language` = '" . $data['user_lang'] . "', "
                . "`reg_expired` = '" . $data['reg_expired'] . "' "
                . "WHERE `id`=" . $data['user_id'];
        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString();
        }

        return $toret;
    }

    public function addUser($data) {
        $groups = $this->getUserGroups();
        $group_id = '';
        foreach ($groups as $value) {
            if ($value['name'] === $data['user_group']) {
                $group_id = $value['id'];
                break;
            }
        }

        $sql = "INSERT INTO `" . DB_PREFIX . "users`(`first_name`,"
                . "`patronymic`,"
                . "`last_name`,"
                . "`login`,"
                . "`pwd`,"
                . "`password`,"
                . "`email`,"
                . "`group`,"
                . "`active`,"
                . "`session_id`,"
                . "`language`,"
                . "`reg_expired`) VALUES('" . $data['first_name'] . "',"
                . "'" . $data['patronymic'] . "',"
                . "'" . $data['lastname'] . "',"
                . "'" . $data['login'] . "',"
                . "'" . $data['pwd'] . "',"
                . "'" . md5($data['pwd']) . "',"
                . "'" . $data['email'] . "',"
                . $group_id . ","
                . $data['isactive'] . ","
                . "'" . $data['cur_sess_id'] . "',"
                . "'" . $data['user_lang'] . "',"
                . "'" . $data['reg_expired'] . "')";

        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $sql . PHP_EOL . $exc->getTraceAsString();
        }

        return $toret;
    }

}
