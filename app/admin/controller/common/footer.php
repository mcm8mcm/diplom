<?php
class ControllerCommonFooter extends Controller {
    public function index() {
        $header = $this->load->view('common/footer', array());
        return $header;
    }        
}
