<?php
class ModelEditors extends Model {
    
    public function getUserGroups(){
        $sql = 'SELECT * FROM `'.DB_PREFIX.'user_group`';
        $res = $this->db->sql($sql);
        return $res['rows'];
    }
    
    public function getUsers() {
        $sql = 'SELECT `u`.*, ' 
        .'`ugroup`.`name` as `group_name` '
        .'FROM `'. DB_PREFIX .'users` AS `u` LEFT JOIN `'
        .DB_PREFIX.'user_group`  AS `ugroup` ON `u`.`group` = `ugroup`.`id`';

        $users = array();
        $res = $this->db->sql($sql);
        $users = $res['rows'];
        $groups = array();
        $groups = $this->getUserGroups();
        $lang = $this->getLanguages();
        return array('user'=>$users, 'groups'=>$groups, 'lang'=>$lang);
    }
    
    public function getNews() {
        $sql = 'SELECT * FROM `'.DB_PREFIX.'news`';
        $res = $this->db->sql($sql);
        return $res['rows'];
    }

    public function addArticle($data) {
        $sql = "INSERT INTO `".DB_PREFIX."news`(`title`,`article`,`added`,`archive`) "
                . "VALUES('".$data['article_title']."',"
                . "'".$data['article_content']."',"
                . "'".$data['creation_date']."',"
                .$data['is_archive'].")";
        
        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString().PHP_EOL.$sql;
        }
        
        return $toret;        
    }

    public function editArticle($data) {
        $sql = "UPDATE `".DB_PREFIX."news` SET "
                . "`title` = '".$data['article_title']."', "
                . "`article` = '".$data['article_content']."', "
                . "`added` = '".$data['creation_date']."', "
                . "`archive` = ".$data['is_archive']." "
                . "WHERE `id` = ".$data['art_id'];

        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString().PHP_EOL.$sql;
        }
        
        return $toret;                
    }

    public function deleteArticle($data) {
        $sql = "DELETE FROM `".DB_PREFIX."news` WHERE `id`=".$data['art_id'];
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
        $filename = DIR_DOWNLOAD.'footers'.DS.$data.'_footer_template.html';
        
        if(!is_file($filename)){
            return '';
        }
        $content = file_get_contents($filename);
        return $content ? $content : '';
    }

    public function saveFooterData($data) {
        $filename = DIR_DOWNLOAD.'footers'.DS.$data['zone'].'_footer_template.html';
        
        $toret = array();
        try {
            $res = file_put_contents($filename, $data['content']);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString();
        }
        
        if(!$ret){
           $toret['error'] = $ret;
        }
        
        return $toret;                
    }
       
    public function getLanguages() {
        $sql = 'SELECT * FROM `'.DB_PREFIX.'languages`';
        $res = $this->db->sql($sql);
        
        foreach ($res['rows'] as $key => $value) {
            
            if (!empty($value['flag'])){
                $tmp = explode('/', $value['flag']);
                $flag = strtoupper(explode(".", $tmp[count($tmp) - 1])[0]);
                $res['rows'][$key]['flag_name'] = $flag;
            }
        }
        return($res['rows']);        
    }

    public function addLanguage($data) {
        $sql = "INSERT INTO `".DB_PREFIX."languages` VALUES('".$data['lang_name']."',"
                . "'".$data['short_name']."',"
                . "'".$data['currency']."',"
                . "'".$data['flag']."',"
                .$data['is_active'].","
                . "'".$data['description']."')";
        
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
        $sql = "UPDATE `".DB_PREFIX."users` SET `language`='' WHERE `language`='".$lang_id."'";
        $this->db->sql($sql);
        $sql = "DELETE FROM `".DB_PREFIX."languages` WHERE `name`='".$lang_id."'";
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
        $sql = "UPDATE `".DB_PREFIX."languages` SET "
                . "`name` = '".$data['lang_name']."', "
                . "`short_name` = '".$data['short_name']."', "
                . "`currency` = '".$data['currency']."', "
                . "`active` = ".$data['is_active'].", "
                . "`flag` = '".$data['flag']."', "
                . "`lang_word` = '".$data['description']."' "
                . "WHERE `name` = '".$old_name."'";

        $toret = array();
        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $exc->getTraceAsString().PHP_EOL.$sql;
        }
        
        return $toret;                
    }
    
    public function getFlags() {
        $toret = array();
        $path = ICLUDE_URL.DS.'img'.DS.'flags';
        $files = scandir(APP_PATH.DS.$path);
        
        foreach ($files as $value) {
            if($value === '.' || $value === '..') continue;
            $flag_name = strtoupper(explode('.', $value)[0]);
            $toret[] = array('path'=>$path.DS.$value, 'name'=>$flag_name);
        }
        
        return $toret;
    }
    
    public function getTasks() {
        return(array());
    }
    
    public function postUser($data) {
        $groups = $this->getUserGroups();
        $group_id = '';
        foreach ($groups as $value) {
            if($value['name'] === $data['user_group']){
                $group_id = $value['id'];
                break;
            }
        }
        $sql = "UPDATE `".DB_PREFIX."users` SET "
                ."`first_name` = '".$data['first_name']."', "
                ."`patronymic` = '".$data['patronymic']."', "
                ."`last_name` = '".$data['lastname']."', "
                ."`login` = '".$data['login']."', "
                ."`pwd` = '".$data['pwd']."', "
                ."`password` = '".md5($data['pwd'])."', "
                ."`email` = '".$data['email']."', "
                ."`group` = ".$group_id.", "
                ."`active` = ".$data['isactive'].", "
                ."`session_id` = '".$data['cur_sess_id']."', "
                ."`language` = '".$data['user_lang']."', "
                ."`reg_expired` = '".$data['reg_expired']."' "
                ."WHERE `id`=" . $data['user_id'];
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
            if($value['name'] === $data['user_group']){
                $group_id = $value['id'];
                break;
            }
        }

        $sql = "INSERT INTO `".DB_PREFIX."users`(`first_name`,"
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
                . "`reg_expired`) VALUES('".$data['first_name']."',"
                . "'".$data['patronymic']."',"
                . "'".$data['lastname']."',"
                . "'".$data['login']."',"
                . "'".$data['pwd']."',"
                . "'".md5($data['pwd'])."',"
                . "'".$data['email']."',"
                .$group_id.","
                .$data['isactive'].","
                . "'".$data['cur_sess_id']."',"
                . "'".$data['user_lang']."',"
                . "'".$data['reg_expired']."')";

        try {
            $this->db->sql($sql);
            $toret['success'] = 'SUCCESS';
        } catch (Exception $exc) {
            $toret['error'] = $sql.PHP_EOL.$exc->getTraceAsString();
        }
        
        return $toret;       
    }
        
}
