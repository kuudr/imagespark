<?php
namespace Core;
class View
{
    public function render($page,$user = [], $articles = [], $article = [], $data = [], $formInfo=[], $users = []) {
        extract($article);
        extract($users);
        extract($user);
        extract($data);
        extract($articles);
        extract($formInfo);
        include $page;

    }
}