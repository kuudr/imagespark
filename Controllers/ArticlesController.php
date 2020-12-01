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


    public function getAction(){


        $articles = $this->articlesModel->getFromDB();

        $this->view->render('Views/articles/articles.php', ['articles' => $articles]);

    }

    public function viewAction()
    {

        $article = $this->articlesModel->get();

        $this->view->render('Views/articles/articleView.php', ['article' => $article]);

    }


    public function createAction()
    {
        if (Router::getInstance()->get('article_create') === '1') {

            $formInfo = Router::getInstance()->getFormInfo();

            $formInfo['created_at'] = date("Y-m-d H:i");
            $insertIntoDB = [
                'article_name' => '',
                'text' => '',
                'created_by' => '',
                'created_at' => '',
            ];

            $insertIntoDB['article_name'] .= $formInfo['article_name'];
            $insertIntoDB['text'] .= $formInfo['text'];
            $insertIntoDB['created_by'] .= $formInfo['created_by'];
            $insertIntoDB['created_at'] .= $formInfo['created_at'];

            $insertIntoDB = array_map(function ($value) {

                if (is_int($value)) {
                    return $value;
                }
                return "'" . $value . "'";
            }, $insertIntoDB);


            $errors = $this->articlesModel->validate($formInfo);
            if (sizeof($errors) == 0){

                $this->articlesModel->putDB($insertIntoDB);
                header("Location: /articles");
            } else {
                $this->view->render('Views/articles/articlesCreate.php', ['errors' => $errors], ['info' => $formInfo]);
            }
        } else {
            $this->view->render('Views/articles/articlesCreate.php', ['errors' => []]);
        }

    }

    public function updateAction()
    {
        $recordUpdate = $this->articlesModel->get();

        $updateData = Router::getInstance()->getFormInfo();

        if (isset($updateData)){

            if (Router::getInstance()->get('update_article') != '1'){

                $this->view->render('Views/articles/articleUpdate.php', ['article' => $recordUpdate]);


            }else{
                $this->articlesModel->updateArticle($updateData);
                header("Location: /articles");
            }
        }

    }

    public function deleteAction()
    {
        $article = $this->articlesModel->delete();

        $this->view->render('Views/articles/articleDelete.php', ['article' => $article]);
    }

}