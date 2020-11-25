<?php
namespace Controllers;
use Core\Router;
use Models\usersModel;
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

    public function usersAction()
    {
        $users = $this->usersModel->getUsers();
        $this->view->viewUsers($users);
//        $this->view->render('pages/users.php', $users);
    }


    public function userAction()
    {
        $user = $this->usersModel->getUser();
        $this->view->viewUser($user);

    }

    public function updateAction()
    {
        $userUpdate = $this->usersModel->getUser();
        $updateData = Router::getInstance()->getFormInfo();
        if (isset($updateData)) {
            if (Router::getInstance()->get('update') != '1') {
                $this->view->updateUser($userUpdate);
            }else{
                $this->usersModel->updateUser($updateData);
                header("Location: /users");
            }
        }
    }


    public function createAction()
    {
        if (Router::getInstance()->get('submit') === '1') {
            $formData = Router::getInstance()->getFormInfo();
            // Обрабатываем форму
            $errors = $this->usersModel->validateUser($formData);
            if (sizeof($errors) == 0){
                // Форма заполнена корректно
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


    public function deleteUser()
    {
        $id = $this->usersModel->userId;
        $this->usersModel->deleteUser($id);
        $this->view->render('pages/delete.php');
    }


    public function mainAction()
    {
        $this->view->render('pages/main.php');
    }


    public function essenceAction()
    {
        $this->view->render('pages/essence.php');
    }
}
