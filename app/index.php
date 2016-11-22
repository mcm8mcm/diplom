<?php 
require_once './config.php';

require_once './init.php';

$register = new Register();
$loader = new Loader($register);
$register->set('load', $loader);
