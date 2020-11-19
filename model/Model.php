<?php
class usersModel {
    public $allUsers;
    public $userId;

    /**
     * usersModel constructor.
     */
    public function __construct()
    {
        $this->userId = Controller\Router::getInstance()->getRouteParams();
        $this->allUsers = scandir('./data/usersrequests/');
        return $this->userId;
    }

    /**
     * @return array Получаем список всех пользователей из директории
     */
    public function  getUsers(){
        foreach ($this->allUsers as $user){
            $getUser = ("data/usersrequests/$user");
            if (is_file($getUser)){
                $getUser = file("data/usersrequests/$user");
                $getUser = [
                    'login' => $getUser[0],
                    'name' => $getUser[1],
                    'surname' => $getUser[2],
                    'email' => $getUser[3],
                    'address' => $getUser[4],
                ];
                return $getUser;
            }
        }
    }


    public function getUser($userId){



    }

    protected function  createUser(){

    }

    protected function  updateUser(){

    }

    protected function  deleteUser(){

    }

}
