<?php
class ControllerCommonHeader extends Controller {
    public function index($menu = '') {
        $data = array();
        $data['menu']= $menu;
        $data['langmenu'] = $this->load->controller('common/langmenu');
        $data['user'] = '';
        if($this->user->isLoggedIn()){
            $this->load->language('common/header');
            $data['user'] = $this->language->get('logged_user_name').$this->user->getName();
        }
        $header = $this->load->view('common/header', $data);
        return $header;
    }
}
