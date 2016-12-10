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

$sql = "SELECT * FROM `languages`";
$languages = $db->sql($sql)['rows'];

$register->set('languages', $languages);

$lang = 'english';
foreach ($languages as $language) {
    if($language['active'] === '1'){
        $lang = $language['name'];
        break;
    }
}

$set_new_lang = FALSE;
if (isset($_GET['set_lang'])) {
    $lang = $_GET['set_lang'];
    $set_new_lang = TRUE;
    foreach ($languages as $language) {
        $language['active'] = '0';
        if ($language['name'] === $lang) {
            $language['active'] = '1';
        }
    }
}

$user = new User($register);

if($user->isLoggedIn()){
   if($set_new_lang){
       $user->setLang($lang, $register);
   } else {
       if(!empty($user->getLang())){
           $lang = $user->getLang();//User has highest priority
       }
   }   
}

$register->set('user', $user);

$language = new Language(DIR_LANG.$lang);
$register->set('language', $language);

if($request->server['REQUEST_URI'] === '/'){
    $request->server['REQUEST_URI'] = $request->server['REQUEST_URI'] . 'home';
}

//ddd($request->server['REQUEST_URI']);

$loader->controller($request->server['REQUEST_URI']);
