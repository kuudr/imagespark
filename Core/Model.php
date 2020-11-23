<?php
namespace Core;
class usersModel
{
    public $userId;
    protected $userFile;

    /**
     * usersModel constructor.
     */
    public function __construct()
    {
//        $this->userFile = $this->userId['id'] . '.json';
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

    public function getUser()
    {
        $viewUserFile = file_get_contents("data/usersrequests/$this->userFile");
        return (explode("\n", $viewUserFile));
    }

    protected function createUser()
    {


    }

    protected function updateUser()
    {

    }

    protected function deleteUser()
    {

    }
}