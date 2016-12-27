<?php
class ModelUser extends Model {
    public function getUser($login, $password) {
        $login = strtoupper($login);
        $sql = "SELECT * FROM `" . DB_PREFIX . "users` where UPPER(`login`)='$login' AND `password`=MD5($password)";
        $res = $this->db->sql($sql);
        if(count($res)){
            return $res;
        } else {
            return FALSE;
        }
    }
}
