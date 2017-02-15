<?php
class Loader {	
    private $register;


        public function __construct($register){
            $this->register = $register;
	}
	
	private function upperUnderscore($source, $delim_char='_') {
		$elems = explode ( $delim_char, $source );
		$toret = '';
		foreach ( $elems as $element ) {
			$toret .= ucfirst ( $element );
		}
		return $toret;
	}
	
	public function controller($route, $data = array()) {
            //echo $route.'<br>';
		$class_path = DIR_APPLICATION . 'controller';
                $route = trim( explode('?', $route)[0] );
                $route = str_replace('\\', '/', $route);
                if(substr($route, strlen($route) - 1, 1) === '/'){
                    $route = substr($route, 0, strlen($route) - 1);
                }
                
		$file = '';
		$class = 'Controller';
		$controller = null;
		$action = '';
		$args = array (); // Will replace $data if exists
		$path_elem = explode ( '/', str_replace ( '\\', '/', $route ) );
                
		while ( $path_elem ) {
			$curr_elem = current ( $path_elem );
			array_shift ( $path_elem );
			$class_path .= '/' . $curr_elem;
			$file = $class_path . '.php';

                        if (is_file ( $file )) {
				$class .= $this->upperUnderscore ( $curr_elem );
				include_once ($file);
				$controller = new $class ($this->register);
				break;
			} else {
				$class .= $this->upperUnderscore ( $curr_elem );
			}
		}

		if ($path_elem) {
			// Here are more elements - frist is action
			$action = current ( $path_elem );
			array_shift ( $path_elem );
		} else {
			$action = 'index';
		}
		
		if ($path_elem) {
			// Arguments
			$data = $path_elem;
		}

		$result = '';
		if (is_callable ( array (
				$controller,
				$action 
		) )) {
                        $result = call_user_func ( array (
					$controller,
					$action 
			), $data );
		} else {
                    return $this->controller('common/404', array());
                }
		
		return $result;
	}
	
	public function model($model,  $data = array()){
		$file = str_replace('\\', '/', DIR_APPLICATION).strtolower('model/'.$model.'.php');
		$class = 'Model'.$this->upperUnderscore($model);
                $class = $this->upperUnderscore($class, '/');
                
                if(is_file($file)){
                    require_once($file);
                    $this->register->set('model_'. str_replace('/', '_', $model), new $class($this->register));
		}else {
                    throw new Exception('Could not load model ' . $model);
                    exit();
		}
	}
	
	public function view($view,  $data = array()){
		$file = str_replace('\\', '/', DIR_APPLICATION).strtolower('view/'.$view.'.tpl');
		$res = '';
		
		if(is_file($file)){
			extract($data);
			ob_start();
			require($file);
			$res = ob_get_contents();
			ob_end_clean();
		}else{
			throw new Exception('Could find view ' . $view);
			exit();
		}
		
		return $res;
	}
	
        public function language($path) {
            $this->register->get('language')->load($path);
        }
}

