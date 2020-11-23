<?php
namespace Core;
class View
{
    public function renderEssence(){
        return include 'pages/essence.php';
    }


    public function renderMain(){
        return include 'pages/main.php';
    }

    public function renderUsers(){
        return include 'pages/users.php';
    }

}