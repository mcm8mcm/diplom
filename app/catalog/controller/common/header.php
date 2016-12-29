<?php
class ControllerCommonHeader extends Controller {
    public function index($menu = '') {
        $data = array('menu'=>$menu);
        $header = $this->load->view('common/header', $data);
        return $header;
    }
}
