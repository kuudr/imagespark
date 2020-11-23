<?php
namespace Controllers;
use Core\usersModel;
use Core\View;
class usersController
{
    protected $users;

    public function __construct(){
        $this->users = new usersModel();

    }


    public function createUser(){
        echo 'Создать пользователя';
    }


    public function deleteUser(){
        echo 'Delete';
    }


    public function updateUser(){
        echo 'Update';
    }

    public function viewUser(){
        echo 'View user';
    }


    public function usersAction(){
        $users = new View();
        $users->renderUsers();
        $users = new usersModel();
        $users->getUsers();
    }

    public function mainAction(){
        $main = new View();
        $main->renderMain();
    }


    public function essenceAction(){
        $essence = new View();
        $essence->renderEssence();
    }
}
