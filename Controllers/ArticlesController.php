<?php
namespace Controllers;
use Models\articleModel;
use Core\View;
use Core\Router;


class articlesController
{
    protected $articlesModel;
    protected $view;



    public function __construct()
    {
        $this->articlesModel = new articleModel();
        $this->view = new View();


    }


    public function articlesAction()
    {
        $articles = $this->articlesModel->getAll();
        $this->view->viewArticles($articles);



    }
//    public function getAllArticles()
//    {
//
//        $articles = $this->articlesModel->getAll();
//        var_dump($articles);
//        $this->view->viewArticles();
//
//    }


    public function createAction()
    {
        if (Router::getInstance()->get('article_create') === '1') {
            $formInfo = Router::getInstance()->getFormInfo();
            $formInfo['date'] = date("Y-m-d H:i:s");
            $errors = $this->articlesModel->validateArticle($formInfo);
            if (sizeof($errors) == 0){
                $this->articlesModel->createArticle($formInfo);
                header("Location: /articles");
            } else {
                $this->view->render('pages/articles/articlesCreate.php', ['errors' => $errors], ['info' => $formInfo]);
            }
        } else {
            $this->view->render('pages/articles/articlesCreate.php', ['errors' => []]);
        }

    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }

    public function viewAction()
    {

    }

}