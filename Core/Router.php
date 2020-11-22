<?php
namespace Core;
use Controllers\usersController;
class Router
{
    private $routeParams;
    private $routes;
    public static $_instance;
    public function __construct()
    {
        $this->routes = [

            '/' =>
                [
                    'controller' => 'userController',
                    'action' => 'mainController',
                ],
            '/essence' =>
                [
                    'controller' => 'userController',
                    'action' => 'essenceController',
                ],
            '/users' =>
                [
                    'controller' => 'userController',
                    'action' => 'usersController',
                ],
            '/users/create' =>
                [
                    'controller' => 'userController',
                    'action' => 'createUser',
                ],
            '/user/{id}/update' =>
                [
                    'controller' => 'userController',
                    'action' => 'updateUser',
                ],
            '/user/{id}/delete' =>
                [
                    'controller' => 'userController',
                    'action' => 'deleteUser',
                ],
            '/user/{id}/view' =>
                [
                    'controller' => 'userController',
                    'action' => 'viewUser',
                ],
        ];
    }

//    Singleton
    public static function getInstance(): Router
    {
        if (null === self::$_instance) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    public function parse()
    {
        $uri = $_SERVER['REQUEST_URI'];
        foreach ($this->routes as $route => $file) {

            $match = true;
            $param = [];
            $routeParts = explode('/', $route);
            $uriParts = explode('/', $uri);
            foreach ($uriParts as $key => $uriPartName) {
                if (!isset($routeParts[$key])) {
                    $match = false;
                    continue;
                }
                if (substr($routeParts[$key], 0, 1) == '{' && substr($routeParts[$key], -1, 1) == '}') {
                    $match = true;
                    $param[trim($routeParts[$key], '{}')] = $uriParts[$key];

                } elseif ($routeParts[$key] !== $uriParts[$key]) {
                    $match = false;
                }

            }
            if ($match) {
                if (isset($file['action'])) {
                    include  'Controllers/' . $file['controller'] . '.php';
                    var_dump($file['action']);
                    $action = new usersController();
                    $action->{$file["action"]}();
                    break;
                }
                die('404');
            }
        }
    }

    public function getFormInfo(){
        $formArray = $_POST;
        if (isset($formArray)){
            return $formArray;
        }
    }
    public function getRouteParams()
    {
        return $this->routeParams;
    }
}





