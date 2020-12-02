<?php
namespace Models;
use Core\Model;
class usersModel extends Model

{
    protected $table = 'users';

    protected $columns = 'login, name, surname, email, address';

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

    public function update($data)
    {

        $table = $this->table;

        $id = $this->record;

        $db = self::setDB();

        $updateArr = [
            'id' => $id,
            'login' => $data['login'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'address' => $data['address'],

        ];

        $sql = "UPDATE $table SET login=:login, name=:name, surname=:surname, email=:email, address=:address WHERE id=:id";

        $stmt = $db->prepare($sql);
        $stmt->execute($updateArr);
    }

}