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
            $data['exit_caption'] = $this->language->get('exit_caption');
            $data['action_logout'] = $this->response->url('auth/logout');
            if(isset($this->request->server['HTTP_REFERER'])){
                $data['redirect'] = $this->request->server['HTTP_REFERER'];
            }else{
                $data['redirect'] = $this->request->server['REQUEST_URI'];
            }
        }
        $header = $this->load->view('common/header', $data);
        return $header;
    }
}
