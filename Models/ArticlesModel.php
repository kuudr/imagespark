<?php
namespace Models;
use Core\Model;

class articleModel extends Model
{
    protected $storageDirectoryPath = './data/articles/';
    protected $attributes = [
        'id' => '',
        'article_name' => '',
        'text' => '',
        'created_by' => '',
        'date' => '',
    ];

    public function getAllArticles()
    {
        parent::getAll();

    }


    public function validateArticle($formInfo)
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


    public function createArticle($formInfo)
    {
        parent::create($formInfo);
    }

}