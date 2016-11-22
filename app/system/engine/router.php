<?php
class router {
	private $path;
	private $controller;
	private $action;
	private $args;
	
	public function __construct(){
		$this->path = '';
		$this->controller = DEFAULT_CONTROLLER;
		$this->action = DEFAULT_ACTION;
		$this->args = array();
		
		$requested_uri = strtolower(explode('?', trim($_SERVER['REQUEST_URI'], '/'))[0]);
		
		$set_not_found = true;
		if($requested_uri === CATALOG || $requested_uri === ADMIN || empty($requested_uri)){
			$set_not_found = false;//Will use index by default for catalog or admin
		}
		
		$uri_elements = explode('/', $requested_uri);
		
		if(count($uri_elements)){
			if($uri_elements[0] !== CATALOG && $uri_elements[0] !== ADMIN){
				//Must start either from 'catalog' or from 'admin'. 
				//'catalog' as default
				array_unshift($uri_elements, CATALOG); 
			}
		}
				
		$tmp_element = current($uri_elements);
		
		$this->path = $tmp_element === ADMIN ? ADMIN_PATH.DS.'controller' : CATALOG_PATH.DS.'controller';
		array_shift($uri_elements);
				
		$tart_path = $this->path;	
		$tmp_path = $tart_path;
				
		while ( count ( $uri_elements ) ) {
			$uri_element = current ( $uri_elements );
			$tmp_path = $tmp_path . DS . $uri_element;
			array_shift ( $uri_elements );
			echo $tmp_path . '.php';
			var_export(file_exists ($tmp_path . '.php'));
			if (file_exists ( $tmp_path . '.php' )) {
				$this->path = $tmp_path . '.php';
				$this->controller = $uri_element;
				$set_not_found = false;
				break;
			}
		}

		if( count ( $uri_elements ) ){
			$this->action = current($uri_elements);
			array_shift ( $uri_elements );
		}
		
		if($set_not_found){
			$this->controller = DEFAULT_CONTROLLER_NOT_FOUND;
		}
		
		$this->args = $uri_elements; 
	}
	
	public function getPath(){
		return $this->path;
	}
	
	public function getController(){
		return $this->controller;
	}
	
	public function getAction(){
		return $this->action;
	}
	
	public function getArgs(){
		return $this->args;
	}
	
}