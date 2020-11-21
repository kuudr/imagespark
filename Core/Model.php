<?php

class usersModel
{

    public $userId;
    protected $userFile;

    /**
     * usersModel constructor.
     */
    public function __construct()
    {
        $this->userFile = $this->userId['id'] . '.json';
    }

    /**
     * @return array Получаем список всех пользователей из директории
     */
    public function getUsers()
    {
        $allUsers = scandir('./data/usersrequests/');
        foreach ($allUsers as $user) {
            $getUser = ("data/usersrequests/$user");
            if (is_file($getUser)) {
                $getUser = file("data/usersrequests/$user");
                $getUsers = [
                    'login' => $getUser[0],
                    'name' => $getUser[1],
                    'surname' => $getUser[2],
                    'email' => $getUser[3],
                    'address' => $getUser[4],
                ];
//                return $getUsers;
                var_dump($getUsers);
            }

        }
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
