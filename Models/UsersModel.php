<?php
namespace Models;
use Core\Model;
class usersModel extends Model

{
    protected $table = 'imagespark.users';

    protected $columns = 'login, name, surname, email, address';

    public function get()
    {
        return parent::getFromDB();

    }

    public function getUser()
    {
        return parent::get();
    }


    public function validate($formInfo)
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


    public function create($formInfo)
    {
        parent::putDB($formInfo);
    }

    public function delete(){

        parent:: delete();

    }


    public function update($data){

        parent::updateUser($data);

    }
}