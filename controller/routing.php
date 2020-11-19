<?php
namespace Controller;
class Router
{
    private $routeParams;
    private array $routes;
    public static $_instance;
    public function __construct()
    {
        $this->routes = [
            '/' => 'pages/main.php',
            '/users' => 'pages/users.php',
            '/essence' => 'pages/essence.php',
            '/users/create' => 'pages/create.php',
            '/users/{id}/view' => 'pages/view.php',
            '/users/{id}/delete' => 'pages/delete.php',
            '/users/{id}/update' => 'pages/update.php',
            '/users/view' => 'pages/view.php',
            '/users/delete' => 'pages/delete.php',
            '/users/update' => 'pages/update.php',

        ];
    }
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
                $this->routeParams = $param;
                return $file;
            }
        }
        die('404');
    }
    public function getRouteParams()
    {
        return $this->routeParams;
    }
}




