<?php
namespace Models;
use Core\Model;

class articleModel extends Model
{
    protected $storageDirectoryPath = './data/articles/';

    public $table = 'imagespark.articles';

    public $columnsToInsert = 'article_name, text, created_by, created_at';

    public $columnsToUpdate = [
        'article_name' => '',
        'text' => '',
    ];

    public $valuesToRender = "article_name, text, created_by, created_at";



    public function getFromDB()
    {
        return parent::getFromDB();

    }

    public function getArticle()
    {
        return parent::get();
    }




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


    public function create($formInfo)
    {
        parent::putDB($formInfo);
    }


    public function delete(){

        parent:: delete();

    }


    public function update($data){

        return parent::update($data);

    }

}