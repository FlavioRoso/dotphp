<?php
//ini_set('error_reporting', E_ALL);ini_set('display_errors', E_ALL);
header('Content-Type: text/html; charset=utf-8');
header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
define('BASEPATH',__DIR__);
define('DS', '/');


//error_reporting(0);

require_once 'vendor/autoload.php';

require_once 'Enkel/App.php';


\Enkel\App::run();







