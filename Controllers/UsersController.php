<?php
namespace Controllers;
use Core\Router;
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



    public function updateAction(){

        $userUpdate = $this->usersModel->getUser();
        $this->view->updateUser($userUpdate);
        $validate = $this->usersModel->validateUser();
        if (isset($validate)){
            if (sizeof($validate) == 0){
                $this->usersModel->updateUser();
                header("Location: /users");
            }
        }
    }



    public function createAction(){
        if (Router::getInstance()->get('submit') === '1') {
            $formData = Router::getInstance()->getFormInfo();
            // Обрабатываем форму
            $errors = $this->usersModel->validateUser($formData);
            if (sizeof($errors) == 0){
                // ФОрма заполнена корректно
                $this->usersModel->createUser($formData);

                header("Location: /users");
            } else {
                // Некорректно
                $this->view->render('pages/create.php', ['errors' => $errors]);
            }

        } else {
            // Кнопку не нажимали, просто показываем пустую форму
            $this->view->render('pages/create.php', ['errors' => []]);
        }

    }


    public function deleteUser(){
        $id = $this->usersModel->userId;
        $this->view->deleteUser();
        $this->usersModel->deleteUser($id);
    }


    public function mainAction(){
        $this->view->viewMain();
    }


    public function essenceAction(){
        $this->view->viewEssence();
    }
}
