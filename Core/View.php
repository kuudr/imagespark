<?php
namespace Core;
class View
{
    public function render($page, $data = [], $formInfo=[], $article = []) {
        extract($data);
        extract($article);
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


    public function updateUser($user){
        return include 'pages/update.php';
    }


    /**
     * Статьи
     */

    public function viewArticles($articles){
        return include 'pages/articles/articles.php';
    }

    public function deleteArticle($article){
        return include 'pages/articles/articleDelete.php';
    }

    public function updateArticle($article){
        return include 'pages/articles/articleUpdate.php';
    }




}