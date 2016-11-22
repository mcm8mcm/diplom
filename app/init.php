<?php
function autoloader_lib($class_name){
	$path = str_replace('\\', '/', strtolower(SYSTEM_PATH.'lib'.DS.$class_name)).'.php';
	if(is_file($path)){
		require_once($path);
	}
}

spl_autoload_register('autoloader_lib');

require_once ENGINE_PATH.'register.php';
require_once ENGINE_PATH.'controller.php';
require_once ENGINE_PATH.'loader.php';
require_once ENGINE_PATH.'model.php';
require_once ENGINE_PATH.'session.php';
require_once ENGINE_PATH.'response.php';
require_once ENGINE_PATH.'request.php';

