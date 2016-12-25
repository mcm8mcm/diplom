<?php

class ModelAuthSignup extends Model {

    private function clearExpired() {
        $sql = "SELECT * FROM `users` WHERE `reg_expired` IS NOT NULL AND `reg_expired` < NOW() AND `active` <> 1";
        $res = $this->db->sql($sql);
        if ($res['rows_count']) {
            $ids = implode(',', array_column('id', $res['rows']));
            $sql = "DELETE FROM `users` WHERE `id` IN (" . $ids . ")";
            $res = $this->db->sql($sql);
        }
    }

    public function isUserExists($user_name) {
        $this->clearExpired();
        $sql = "SELECT `id` FROM `users` WHERE UPPER(`login`) = '" . strtoupper($user_name) . "'";
        $res = $this->db->sql($sql);
        return $res['rows_count'] ? TRUE : FALSE;
    }

    public function confirmUser($md5_pwd_md5, $login) {
        $this->clearExpired();
        $sql = "SELECT `id` from `users` WHERE MD5(`password`) = '" . $md5_pwd_md5 . "' AND UPPER(`login`) = '" . strtoupper($login) . "'";
        $res = $this->db->sql($sql);
        if (!$res['rows_count']) {
            return 'NOT_EXISTS';
        }
        $sql = "UPDATE TABLE `users` SET `active` = 1 WHERE MD5(`password`) = '" . $md5_pwd_md5 . "' AND UPPER(`login`) = '" . strtoupper($login) . "'";
        $res = $this->db->sql($sql);
        if (!$this->db->rowsAffected()) {
            return 'NOT_ACTIVATED';
        } else {
            return 'SUCCESS';
        }
    }

    public function addUser($data) {
        
    }
}
