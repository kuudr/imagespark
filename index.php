<?php
include "data/includes.php";
define('ASSETS_ROOT','/assets/');
use Core\Router;
$params = Router::getInstance()->getRouteParams();
include "views/header.php";
$router = Router::getInstance()->parse();
