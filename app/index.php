<?php 
require_once './config.php';

require_once './init.php';


require_once DIR_VENDOR.'raveren'.DS.'kint'.DS.'Kint.class.php';
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

$user = new User($register);
$register->set('user', $user);

$conf = new AppConfig($db);
$register->set('config', $conf);

$lang = 'english';
$from_user = FALSE;

//dd($register);

if($user->isLoggedIn()){
   $lang = $conf->getOption('lang', 'user', $user->getID());
   if($lang){
      $from_user = TRUE; 
   }
   
}

if(!$from_user){
   $res = $conf->getOption('lang', 'all', 'default');
   echo $res;
   if($res){
       $lang = $res;
   }    
}

exit();

$language = new Language(DIR_LANG.$lang);
$register->set('language', $language);

$loader->controller($request->server['REQUEST_URI']);
