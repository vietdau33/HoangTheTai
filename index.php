<?php

define('DS', DIRECTORY_SEPARATOR);
define('TS', __DIR__ . DS);
define('BASE_PATH', TS);
define('PUBLIC_PATH', TS . 'public' . DS);
define('LANG', 'en');

date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once TS . 'vendor' . DS . 'requireMv.php';
require_once TS . 'function.php';

//Environment
if(config('app', 'environment') == 'develop'){
    error_reporting(E_ALL);
    @ini_set('display_errors', 1);
}else{
    error_reporting(0);
    @ini_set('display_errors', 0);
}

//session start
if(!isset($_SESSION)) session_start();

//get language
$language = [];
if(file_exists(TS . 'language' . DS . LANG . '.php')){
    $language = require_once TS . 'language' . DS . LANG . '.php';
}


// $base_url = config('app', 'base_url');
$base_url= url() ?? config('app', 'base_url')
;
if($base_url == null){
    MV_die('base_url_not_config');
}

$base_url = preg_replace('/\/$/', '', $base_url);
define('BASE_URL', $base_url);
define('PUBLIC_URL', BASE_URL . '/public/');

$controller = $_GET['controller'];
$action = $_GET['action'] ?? '';
$params = $_GET['params'] ?? '';

$controller = explode('_', $controller);
foreach ($controller as $item => &$vals){
    $vals = ucfirst(strtolower($vals));
}
$controller = implode('', $controller) . 'Controller';
$action = $action == '' ? 'index' : $action;

//require base
foreach(getAllFiles('base') as $file){
    require_once $file;
}
//require models
foreach(getAllFiles('models') as $file){
    require_once $file;
}
//require controller
foreach(getAllFiles('controller') as $file){
    require_once $file;
}

if(!file_exists(TS . 'controller' . DS . $controller . '.php')){
    MV_die('url_not_found');
}

if(!method_exists($controller, $action)){
    MV_die('method_not_found');
}

removeHtmlTagGetAndPost();

(new $controller())->{$action}();
