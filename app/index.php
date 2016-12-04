<?php 
require_once './config.php';

require_once './init.php';
require_once DIR_LIB.'document/document.php';

$register = new Register();

$loader = new Loader($register);
$register->set('load', $loader);

$request = new Request();
$register->set('request', $request);

$response = new Response();
$register->set('response', $response);

$session = new Session();
$register->set('session', $session);

$document = new Document();
$register->set('document', $document);

$db = new DB(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_BASE);
$register->set('db', $db);

$language = new Language(DIR_LANG);
$register->set('language', $language);

$user = new User($register);
$register->set('user', $user);

$loader->controller($request->server['REQUEST_URI']);


//var_export($register);
