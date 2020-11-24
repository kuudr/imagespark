<?php
namespace Core;
use Core\Router;
class usersModel
{
    public $userId;
    public $formInfo;
    /**
     * usersModel constructor.
     */
    public function __construct()
    {
        $this->formInfo = Router::getInstance()->getFormInfo();
    }

    /**
     * @return array Получаем список всех пользователей из директории
     */
    public function getUsers()
    {
        $allUsers = scandir('./data/usersrequests/');
        $usersArr = [];
        foreach ($allUsers as $user) {
            $getUser = ("data/usersrequests/$user");
            if (is_file($getUser)) {
                $getUser = file("data/usersrequests/$user");
                $getUsers = [
                    'login' => trim($getUser[0]),
                    'name' => trim($getUser[1]),
                    'surname' => trim($getUser[2]),
                    'email' => trim($getUser[3]),
                    'address' => trim($getUser[4]),
                ];
                $usersArr[] = $getUsers;
            }
        }
        return $usersArr;

    }

    /**
     * @return mixed|string
     */
    public function getUserId(){
        $parseUri = explode('/',$_SERVER['REQUEST_URI']);
        $userId = $parseUri[2];
        return $userId;
    }

    /**
     * @return array Массив одного пользователя
     */

    public function getUser()
    {
        $userId = $this->getUserId();
        $userFile = $userId . '.json';
        $viewUserFile = file_get_contents("data/usersrequests/$userFile");
        $viewUserFile = explode("\n", $viewUserFile);
        $viewUserFile = [
            'login' => $viewUserFile[0],
            'name' => $viewUserFile[1],
            'email' => $viewUserFile[2],
            'surname' => $viewUserFile[3],
            'address' => $viewUserFile[4],
        ];
        return $viewUserFile;
    }

    /**
     * @return array Массив ошибок
     */
    public function validateUser()
    {
        $formInfo = Router::getInstance()->getFormInfo();
        $valid = true;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            if (mb_strlen($formInfo['login']) < 3){
                $errors[] = 'Логин должен быть больше 3 символов';
            }
            if (mb_strlen($formInfo['name']) < 2){
                $errors[] = 'Имя должно быть больше 2 символов';
            }
            if (mb_strlen($formInfo['surname']) < 2) {
                $errors[] = 'Фамилия должна быть больше 2 символов';
            }
            if (mb_strlen($formInfo['address']) < 5) {
                $errors[] = 'Адрес должен быть больше 5 символов';
            }
            return $errors;
        }
    }

    public function showErrors(){
        $errors = $this->validateUser();
        if (isset($errors)){
            return $errors;
        }
    }


    public function createUser()
    {
        $formInfo = Router::getInstance()->getFormInfo();
        if (isset($formInfo['login'],$formInfo['name'], $formInfo['surname'], $formInfo['email'], $formInfo['address'] )){
            $login = strip_tags(addslashes($formInfo['login']));
            $name = strip_tags(addslashes($formInfo['name']));
            $surname = strip_tags(addslashes($formInfo['surname']));
            $email = strip_tags(addslashes($formInfo['email']));
            $address = strip_tags(addslashes($formInfo['address']));
            $eol = PHP_EOL;
            $fileNameUsers =  $login . '.json';
            $resultUserRequest = "{$login}{$eol}{$name}{$eol}{$surname}{$eol}{$email}{$eol}{$address}";
            return file_put_contents("data/usersrequests/$fileNameUsers",$resultUserRequest, FILE_APPEND);
        }
    }


    public function deleteUser($id)
    {
        $userFileDelete = $this->getUserId() . '.json';
        $fileRemoveName = "data/usersrequests/$userFileDelete";
        if (file_exists($fileRemoveName)){
            unlink($fileRemoveName);
        }
    }


    protected function updateUser()
    {

    }
}