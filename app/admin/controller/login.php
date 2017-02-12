<?php
class ControllerAuthLogin  extends Controller{
    public function index() {
        $type = $this->request->post['user_type'];
        $redirect_addr = $this->request->post['redirect'];
        $login = $this->request->post['username'];
        $password = $this->request->post['password'];
        $this->user->login($login,$password);  
        $this->response->redirect($redirect_addr);
    }
    
    public function customer($login, $password){
        $login = $this->db->escape($login);
        $password = $this->db->escape($password);
        $login = strtoupper($login);
        $password = md5($password);
        $sql = "SELECT * FROM `".DB_PREFIX."users` WHERE (UPPER(`login`) = '".$login."' OR "
                . "UPPER(`email`) = '".$login."') AND `password` = '".$password."' AND `active` = 1";
        $res = $this->db->sql($sql);
        if(!$res['rows_count']){
            return;
        }
        
        $this->session->data['user'] = $res['row'];
        return;
    }
    
    public function master($login, $password) {
        
    }
}
