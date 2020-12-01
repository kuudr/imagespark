<?php
namespace Core;

class Router
{
    private $routeParams;
    private $routes;
    private $userId;
    private static $_instance;
    public function __construct()
    {
        $this->routes = include 'data/routes.php';
        $this->userId;

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
                include 'Controllers/' . $file['controller'] . '.php';
                $controllerName = 'Controllers\\' . $file['controller'];
                $controller = new $controllerName();
                $controller->{$file['action']}();
                return $param;
            }
        }
    }


    public function getFormInfo()
    {
        $formArray = $_POST;
        if (isset($formArray)){
            return $formArray;
        }
    }

    public function get($name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return null;
    }
    public function getRouteParams()
    {
        return $this->routeParams;
    }

    public function getId(){
        $parseUri = explode('/',$_SERVER['REQUEST_URI']);
        if (isset($parseUri[2])){
            return $parseUri[2];
        }
    }

}




