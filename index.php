<?php
include "data/includes.php";
define('ASSETS_ROOT','/assets/');
use Core\Router;
include "Views/header.php";
$router = Router::getInstance()->parse();



