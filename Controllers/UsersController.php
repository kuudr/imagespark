<?php
namespace Controllers;
use Core\usersModel;
use Core\View;
class usersController
{

    protected $usersModel;
    protected $view;


    public function __construct()
    {
        $this->usersModel = new usersModel();
        $this->view = new View();
    }

    public function usersAction(){
        $users = $this->usersModel->getUsers();
        $this->view->viewUsers($users);
    }


    public function userAction(){
        $user = $this->usersModel->getUser();
        $this->view->viewUser($user);
    }

    public function createAction(){
        $errors = $this->usersModel->showErrors();
        $this->view->createUser($errors);
        $validate = $this->usersModel->validateUser();
        if (isset($validate)){
            if (sizeof($validate) == 0){
                $this->usersModel->createUser();
                header("Location: /users");
            }
        }
    }


    public function deleteUser(){
        $id = $this->usersModel->userId;
        $this->view->deleteUser();
        $this->usersModel->deleteUser($id);

    }


    public function updateUser(){
        echo 'Update';
    }



    public function mainAction(){
        $this->view->viewMain();
    }


    public function essenceAction(){
        $this->view->viewEssence();
    }
}
