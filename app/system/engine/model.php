<?php
class Model{
	private $register;
	
	public function __construct($register){
		$this->register = $register;
	}
	
	public function __get($key){
		return $this->register->get($key);
	}
	
	public function __set($key, $value){
		$this->register->set($key, $value);
	}
}