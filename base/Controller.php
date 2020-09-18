<?php

class Controller{

    public $layout = 'layout.layout';

    public function __construct(){
        //
    }

    public function view($view, $datas = [], $withTemplate = true, $echoData = true){
        extract($datas);
        $_page          = TS . 'views' . DS . $this->getDir($view);
        $_pageLayout    = TS . 'views' . DS . $this->getDir($this->layout);
        if(!file_exists($_page)){
            MV_die('Page view ' . $this->getDir($view) . ' not found');
        }
        if(!file_exists($_pageLayout)){
            MV_die('Page view ' . $this->getDir($this->layout) . ' not found');
        }
        //$contents is use in template
        $contents = '';
        if($withTemplate){
            $contents = $this->view($view, $datas, false, false);
            $_page = $_pageLayout;
        }
        ob_start();
        include $_page;
        $data = ob_get_contents();
        ob_end_clean();
        if($echoData){
            ob_clean();
            echo $data;
        }
        return $data;
    }
    public function render($view, $datas = []){
        return $this->view($view, $datas, false, false);
    }
    private function getDir($dir, $extension = 'php'){
        return implode(DS, explode('.', $dir)) . '.' . $extension;
    }
    public function post($name = ''){
        if($name == '')
            return $_POST;
        if(!isset($_POST[$name]))
            return null;
        return $_POST[$name];
    }
    public function get($name = ''){
        if($name == '')
            return $_GET;
        if(!isset($_GET[$name]))
            return null;
        return $_GET[$name];
    }

    public function hash_password($password){
        return md5(sha1(md5(sha1($password))));
    }

    public function call($actionCall){
        $actionCall = explode('@', $actionCall);
        $controller = ucfirst(strtolower($actionCall[0])) . 'Controller';
        return (new $controller())->{$actionCall[1]}(true);
    }

    public function isAjax(){
        if(
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
        ){
            return true;
        }
        return false;
    }
}