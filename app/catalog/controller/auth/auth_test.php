<?php
class ControllerAuthAuthTest{
	public function index(){
		echo 'Preved';
	}
	
	public function say($data = array()){
		$res = '';
		foreach ($data as $elem){
			$res .= $elem . '<br>';
		}
		
		return $res;
	}
}