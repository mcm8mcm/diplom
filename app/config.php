<?php
define('APP_PATH', __DIR__);
define('CATALOG', 'catalog');
define('ADMIN', 'admin');
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('DIR_APPLICATION', APP_PATH.DS.'catalog'.DS);
define('SYSTEM_PATH', APP_PATH.DS.'system'.DS);
define('DIR_LIB', SYSTEM_PATH.'lib'.DS);
define('DIR_LANG', DIR_APPLICATION.'language'.DS.'english');
define('ENGINE_PATH', SYSTEM_PATH.DS.'engine'.DS);
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_CONTROLLER_NOT_FOUND', '404');
define('DEFAULT_ACTION', 'index');
//DB
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_BASE', 'service');
define('DB_PREFIX', '');
