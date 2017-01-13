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

$sql = "SELECT * FROM `". DB_PREFIX ."languages`";
$languages = $db->sql($sql)['rows'];

$register->set('languages', $languages);

$lang = 'english';
foreach ($languages as $language) {
    if($language['active'] === '1'){
        $lang = $language['name'];
        break;
    }
}

$user = new User($register);
$register->set('user', $user);

/*
if($user->isLoggedIn()){
   if($set_new_lang){
       $user->setLang($lang);
   } else {
       if(!empty($user->getLang())){
           $lang = $user->getLang();//User has highest priority
       }
   }   
}//But user has right to change language
*/


if (isset($_GET['set_lang'])) {
    $lang = $_GET['set_lang'];
    
    foreach ($languages as $index=>$language) {
        $languages[$index]['active'] = '0';
        if ($language['name'] === $lang) {
            $languages[$index]['active'] = '1';
        }
    }
   
    $sql = "UPDATE `".DB_PREFIX."languages` SET `active` = 0 WHERE `active` = 1";
    $db->sql($sql);
    $sql = "UPDATE `".DB_PREFIX."languages` SET `active` = 1 WHERE `name` = '".$lang."'";
    $db->sql($sql); 
    if($user->isLoggedIn()){
        $user->setLang($lang);
    }
}

$language = new Language(DIR_LANG.$lang);
$register->set('language', $language);

if($request->server['REQUEST_URI'] === '/'){
    $request->server['REQUEST_URI'] = $request->server['REQUEST_URI'] . 'home';
}

$session->data['link'] = explode('?', $request->server['REQUEST_URI'])[0];
$session->data['languages'] = $languages;
foreach ($session->data['languages'] as $value) {
    if($value['active'] === '1'){
        $session->data['language'] = $value['name'];
    }
}

$loader->controller($request->server['REQUEST_URI']);
