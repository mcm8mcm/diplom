<?php
include_once 'config.php';

function autoloader_lib($class_name){
	$path = str_replace('\\', '/', strtolower(SYSTEM_PATH.'lib'.DS.$class_name)).'.php';
	if(is_file($path)){
		require_once($path);
	}
}

spl_autoload_register('autoloader_lib');

