<?php
namespace Core;
class View
{
    public function render($page, $data = [], $formInfo=[]) {
        extract($data);
        extract($formInfo);
        include $page;

    }



    /**
     * Пользователи
     */
    public function viewUser($user)
    {
        include 'pages/view.php';
    }


    public function viewUsers($users){
        return include 'pages/users.php';
    }

    public function deleteUser(){
        return include 'pages/delete.php';
    }


    public function updateUser($user){
        return include 'pages/update.php';
    }

    public function createUser($errors){
        return include 'pages/create.php';
    }

    public function viewEssence(){
        return include 'pages/essence.php';
    }


    public function viewMain(){
        return include 'pages/main.php';
    }

    /**
     * Статьи
     */

    public function viewArticles($articles){
        return include 'pages/articles/articles.php';
    }

    public function createArticle($errors){
        return include 'pages/articles/articlesCreate.php';
    }



}