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
        var_dump($articles);
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
        if (Router::getInstance()->get('article') !== '1') {
            $formData = Router::getInstance()->getFormInfo();

            $errors = $this->articlesModel->validateArticle($formData);
            if (sizeof($errors) == 0){
                $this->articlesModel->createArticle($formData);
//                header("Location: /articles");
            } else {
                $this->view->createArticle($errors);
            }
        } else {
            $this->view->createArticle($errors);
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