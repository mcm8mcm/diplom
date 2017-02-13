<?php
class ControllerCommonHeader extends Controller {
    public function index() {
        $data = array();
        $data['logout'] = $this->load->controller('common/logoutplugin');
        $data['langmenu'] = $this->load->controller('common/langmenu');
        $header = $this->load->view('common/header', $data);
        return $header;
    }
}
