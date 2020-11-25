<?php
namespace Models;
use Core\Model;
class usersModel extends Model

{
    public $userId;
    public $formInfo;

    protected $attributes = [
        'login' => '',
        'name' => '',
        'surname' => '',
        'email' => '',
        'address' => '',
    ];

    protected $storageDirectoryPath = './data/usersrequests/';


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
                $getUsers = [];
//                foreach ($this->attributes as $attribute) {
//                    $getUsers[$attribute] = trim($getUser[$attribute]);
//                }

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
            'surname' => $viewUserFile[2],
            'email' => $viewUserFile[3],
            'address' => $viewUserFile[4],
        ];
        return $viewUserFile;
    }

    /**
     * @return array Массив ошибок
     */
    public function validateUser($formInfo)
    {
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

    public function showErrors(){
        $errors = $this->validateUser();
        if (isset($errors)){
            return $errors;
        }
    }


    public function createUser($formInfo)
    {
        if (isset($formInfo['login'],$formInfo['name'], $formInfo['surname'], $formInfo['email'], $formInfo['address'] )){
            $login = strip_tags(addslashes($formInfo['login']));
            $name = strip_tags(addslashes($formInfo['name']));
            $surname = strip_tags(addslashes($formInfo['surname']));
            $email = strip_tags(addslashes($formInfo['email']));
            $address = strip_tags(addslashes($formInfo['address']));
            $eol = PHP_EOL;
            $fileNameUsers =  $login . '.json';
            $resultUserRequest = "{$login}{$eol}{$name}{$eol}{$surname}{$eol}{$email}{$eol}{$address}";
            return file_put_contents("data/usersrequests/$fileNameUsers",$resultUserRequest);
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



    public function updateUser($updateData)
    {
        $userFileDelete = $this->getUserId() . '.json';
        $fileRemoveName = "data/usersrequests/$userFileDelete";
        unlink($fileRemoveName);
        $loginUpdate = ($updateData['login']);
        $nameUpdate = ($updateData['name']);
        $surnameUpdate = ($updateData['surname']);
        $emailUpdate = ($updateData['email']);
        $addressUpdate = ($updateData['address']);
        $eol = PHP_EOL;
        $fileNameUpdate =  $loginUpdate . '.json';
        $userUpdate = "{$loginUpdate}{$eol}{$nameUpdate}{$eol}{$surnameUpdate}{$eol}{$emailUpdate}{$eol}{$addressUpdate}";
        return file_put_contents("data/usersrequests/$fileNameUpdate",$userUpdate);

    }

}