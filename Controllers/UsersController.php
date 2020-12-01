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

    public function getAction(){

        $users = $this->usersModel->get();

        $this->view->render('Views/users/users.php', ['users' => $users]);

    }


    public function userAction()
    {
        $user = $this->usersModel->getUser();

        $this->view->render('Views/users/userView.php', ['user' => $user]);


    }

    public function createAction()
    {
        if (Router::getInstance()->get('submit') === '1') {
            $formInfo = Router::getInstance()->getFormInfo();

            $insertIntoDB = [
                'login' => '',
                'name' => '',
                'surname' => '',
                'email' => '',
                'address' => '',
            ];

            $insertIntoDB['login'] .= $formInfo['login'];
            $insertIntoDB['name'] .= $formInfo['name'];
            $insertIntoDB['surname'] .= $formInfo['surname'];
            $insertIntoDB['email'] .= $formInfo['email'];
            $insertIntoDB['address'] .= $formInfo['address'];

            $insertIntoDB = array_map(function ($value) {

                if (is_int($value)) {
                    return $value;
                }
                return "'" . $value . "'";
            }, $insertIntoDB);

            // Обрабатываем форму
            $errors = $this->usersModel->validate($formInfo);
            if (sizeof($errors) == 0){
                // Форма заполнена корректно
                $this->usersModel->create($insertIntoDB);

                header("Location: /users");
            } else {
                // Некорректно
                $this->view->render('Views/users/userCreate.php', ['errors' => $errors], ['info' => $formInfo]);
            }

        } else {
            // Кнопку не нажимали, просто показываем пустую форму
            $this->view->render('Views/users/userCreate.php', ['errors' => []]);
        }

    }

    public function updateAction()
    {
        $recordUpdate = $this->usersModel->getUser();

        $updateData = Router::getInstance()->getFormInfo();

        if (isset($updateData)){

            if (Router::getInstance()->get('update') != '1'){

                $this->view->render('Views/users/userUpdate.php', ['user' => $recordUpdate]);


            }else{
                $this->usersModel->updateUser($updateData);
                header("Location: /users");
            }
        }

    }




    public function deleteAction()
    {

        $user = $this->usersModel->delete();

        $this->view->render('Views/users/userDelete.php', ['user' => $user]);


    }


    public function mainAction()
    {
        $this->view->render('Views/users/main.php');
    }


    public function essenceAction()
    {
        $this->view->render('Views/users/essence.php');
    }
}
