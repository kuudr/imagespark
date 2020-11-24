<?php
namespace Core;
class View
{

    public function viewUser($user)
    {
        include 'pages/view.php';
    }


    public function viewUsers($users){
        return include 'pages/users.php';
    }

    public function deleteUser(){
        return include 'pages/delete.php';
    }

    public function createUser($errors){
        return include 'pages/create.php';
    }

    public function viewEssence(){
        return include 'pages/essence.php';
    }


    public function viewMain(){
        return include 'pages/main.php';
    }



}