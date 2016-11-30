<?php
class ControllerCommonHeader extends Controller {
    public function index() {
        $header = $this->load->view('common/header', array());
        return $header;
    }
}
