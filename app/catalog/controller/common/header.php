<?php
class ControllerCommonHeader extends Controller {
    public function index($menu = '') {
        $data = array('menu'=>$menu);
        $data['langmenu'] = $this->load->controller('common/langmenu');
        $header = $this->load->view('common/header', $data);
        return $header;
    }
}
