<?php

$ds = DIRECTORY_SEPARATOR;

$aryRequire = [
    'PdoConnect' => 'PDO' . $ds . 'pdo.php',
    'Session'    => 'Session' . $ds . 'session.php'
];

require_once __DIR__ . $ds . 'autoload.php';
foreach ($aryRequire as $class => $file){
    if(!class_exists($class)){
        require_once __DIR__ . $ds . $file;
    }
}