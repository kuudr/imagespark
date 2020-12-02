<?php
namespace Models;
use Core\Model;

class articleModel extends Model
{

    public $table = 'articles';

    public $columns = 'article_name, text, created_by, created_at';

    public function validate($formInfo)
    {
        $errors = [];
        if (mb_strlen($formInfo['article_name']) < 5){

            $errors[] = 'Название статьи должно быть больше 5 символов';
        }
        if (mb_strlen($formInfo['text']) < 10){
            $errors[] = 'Текст должен быть больше 10 символов';
        }
        if (mb_strlen($formInfo['created_by']) < 5){
            $errors[] = 'Имя должно быть больше 5 символов';
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
            'text' => $data['text'],
            'article_name' => $data['article_name']

        ];

        $sql = "UPDATE $table SET article_name=:article_name, text=:text WHERE id=:id";

        $stmt = $db->prepare($sql);
        $stmt->execute($updateArr);
    }
}