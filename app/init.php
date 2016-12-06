<?php
function autoloader_lib($class_name){
	$path = str_replace('\\', '/', SYSTEM_PATH.'lib'.DS.strtolower($class_name)).'.php';
        
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
require_once ENGINE_PATH.'language.php';
require_once ENGINE_PATH.'db.php';
require_once ENGINE_PATH.'app_config.php';
