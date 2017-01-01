<?php
class ControllerCommon404 extends Controller{
	public function index(){
            $this->load->language('common/404');
		return "<h1>".$this->language->get('message')."</h1>";
	}
}
