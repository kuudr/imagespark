<?php

class mainController{

    public function action1 (){

    }

    public function action2 (){

    }

}

$test = new mainController();


$test->action1();


$a = 'mainController';
$b = 'action2';

$test2 = new $a;

$test2->$b();


$c = [
    'controller' => $a,
    'action' => $b
];



$test3 = new $c['controller'];

$test3->$c['action']();

$d = $c['action'];

$test3->$d();