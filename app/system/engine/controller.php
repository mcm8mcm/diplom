<?php
class Controller{
	private $register;
	
	public function __construct($register){
		$this->register = $register;
	}
	
	public function __get($key){
		$this->register->get($key);
	}
	
	public function __set($key, $value){
		return $this->register->set($key, $value);
	}
}