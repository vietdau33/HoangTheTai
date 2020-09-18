<?php

function __($message){
    global $language;
    if(!isset($language) || !isset($language[$message])){
        return $message;
    }
    return $language[$message];
}

function getAllFiles($folder, $extension = 'php'){
    $result = [];
    foreach (glob(TS . $folder . DS . "*." . $extension) as $filename) {
        $result[] = $filename;
    }
    return $result;
}

function MV_die($message){
    echo '<style>p{text-align:center;margin-top:40px}p span{color:#666;font-size:18px;display:inline-block;padding:18px 22px;background:#eee;border-radius:10px;max-width:calc(100vw - 80px);word-wrap:break-word;box-shadow:0 3px 12px 1px rgba(0,0,0,.3)}</style>';
    echo '<p><span>' . __($message) . '</span></p>';
    die;
}

function config($name, $value = null){
    $config = BASE_PATH . 'config' . DS . $name . '.php';
    if(!file_exists($config)){
        return null;
    }
    $config = include $config;
    if($value != null){
        return $config[$value] ?? null;
    }

    return $config;
}
function response($aryReturn, $json = true){
    $aryReturn = $json ? json_encode($aryReturn) : $aryReturn;
    ob_clean();
    echo $aryReturn;
    return true;
}
function redirect($url){
    $url = preg_replace('/^\//', '', $url);
    $url = preg_replace('/\/$/', '', $url);
    header('Location: ' . BASE_URL . '/' . $url);
    return true;
}

function removeHtmlTagGetAndPost(){
    __rmData($_POST);
    __rmData($_GET);
}

function __rmData(&$datas){
    foreach ($datas as $key => $item){
        if(in_array(gettype($item), ['array', 'object'])){
            __rmData($datas[$key]);
        }else{
            $datas[$key] = strip_tags($datas[$key]);
        }
    }
}

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}