<?php
include "data/includes.php";
define('ASSETS_ROOT','/assets/');
use Core\Router;
include "views/header.php";
$router = Router::getInstance()->parse();
