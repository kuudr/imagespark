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
    public function getAll()
    {

        $articles = $this->articlesModel->getAll();

        $this->view->render('pages/articles/articles.php', ['articles' => $articles]);

    }


    public function createAction()
    {
        if (Router::getInstance()->get('article_create') === '1') {
            $formInfo = Router::getInstance()->getFormInfo();
            $formInfo['date'] = date("Y-m-d H:i:s");
            $errors = $this->articlesModel->validate($formInfo);
            if (sizeof($errors) == 0){
                $this->articlesModel->create($formInfo);
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
        $fileUpdate = $this->articlesModel->get();

        $updateData = Router::getInstance()->getFormInfo();

        if (isset($updateData)){

            if (Router::getInstance()->get('update_article') != '1'){

                $this->view->updateArticle($fileUpdate);

            }else{
                $this->articlesModel->update($updateData);
                header("Location: /articles");
            }
        }

    }

    public function deleteAction()
    {

        $article = $this->articlesModel->delete();

        $this->view->deleteArticle($article);

    }

    public function viewAction()
    {

        $article = $this->articlesModel->get();

        $this->view->render('pages/articles/articleView.php', ['article' => $article]);

    }

}