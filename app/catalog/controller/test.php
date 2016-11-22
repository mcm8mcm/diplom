<?php
class ControllerTest{
	public function actionIndex(){
		echo 'You got me ;)';
	}
	
	public function actionSecond(){
		echo "It's  the second one";
	}
	
}


	function upperUnderscore($source){
		$elems = explode('_', $source);
		$toret = '';
		foreach ($elems as $element){
			$toret .= ucfirst($element);
		}
		
		return $toret;
	}
	
	function controller($route,  $data = array()){
		$class_path = DIR_APPLICATION.'controller';
		$file = '';
		$class = 'Controller';
		$controller = null;
		$action = '';
		$args = array(); //Will replace $data if exists		
		$path_elem = explode('/', str_replace('\\', '/', $route));
		
		while($path_elem){
			$curr_elem = current($path_elem);
			array_shift($path_elem);
			$class_path .= '/'.$curr_elem;
			$file = $class_path.'.php';
			
			if(is_file($file)){
				$class .= upperUnderscore($curr_elem);
				include_once($file);
				$controller = new $class();
				break;
			}else {	
				$class .= upperUnderscore($curr_elem);
			}
		}
			
			if($path_elem){
				//Here are more elements - frist is action
				$action = current($path_elem);
				array_shift($path_elem);
			}else {
				$action = 'index';
			}
			
			if($path_elem){
				//Arguments
				$data = $path_elem;
			}
			
			$result = '';
			if(is_callable(array($controller, $action))){
				$result = call_user_func(array($controller, $action), $data);
			}
			
			return $result;
		}
	
	
	define(DIR_APPLICATION, 'E:\dev\eclipse\sandbox\app/catalog/');
	define('DS', DIRECTORY_SEPARATOR);
	$route = 'auth/auth_test/say/preved/poka';
	
	$a = controller($route);
	