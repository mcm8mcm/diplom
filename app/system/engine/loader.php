<?php
class Loader {	
    private $register;


        public function __construct($register){
            $this->register = $register;
	}
	
	private function upperUnderscore($source) {
		$elems = explode ( '_', $source );
		$toret = '';
		foreach ( $elems as $element ) {
			$toret .= ucfirst ( $element );
		}
		
		return $toret;
	}
	
	public function controller($route, $data = array()) {
		$class_path = DIR_APPLICATION . 'controller';
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
                        //var_dump($file);
                        //echo '<br>';
			//var_dump(is_file ( $file ));
			//echo '<br>';
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
		}
		
		return $result;
	}
	
	public function model($model,  $data = array()){
		$file = str_replace('\\', '/', DIR_APPLICATION).strtolower('model/'.$model.'.php');
		$class = 'Model'.$this->upperUnderscore($model);
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
			require_once($file);
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

