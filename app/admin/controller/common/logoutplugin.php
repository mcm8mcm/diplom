<?php
class ControllerCommonLogoutplugin extends Controller{
    public function index() {
        if(!$this->user->isLoggedIn()){
            return '';
        }
        
        $this->load->language('common/logoutplugin');
        $data = array();
        $data['logout_caption'] = $this->language->get('logout_caption');
        $data['name_caption'] = $this->language->get('name_caption'); 
        $data['name'] = $this->user->getName(); 
        $data['link'] = $this->response->url('login/logout');
        $logout_plugin = $this->load->view('common/logoutplugin', $data);
        return $logout_plugin;
    }
}
