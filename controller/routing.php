<?php
$uri = $_SERVER['REQUEST_URI'];
$routeArr = [
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
foreach ($routeArr as $route => $file) {
    $match = true;
    $param = [];
    $routeParts = explode('/', $route);
    $uriParts = explode('/', $uri);
    foreach ($uriParts as $key => $uriPartName) {
        if (!isset($routeParts[$key])){
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
    if($match){
        $includeFile = $file;
        break;
    }
}

if (isset($param['id'])){
    $getUserId = $param['id'];
}



//User update


function userUpdate($getUserId){
    $viewArr = userView($getUserId);
    $userUpdateArr = [
        'login' => $viewArr[0],
        'name' => $viewArr[1],
        'surname' => $viewArr[2],
        'email' => $viewArr[3],
        'address' => $viewArr[4],
    ];
    return $userUpdateArr;
}


function reWrite($getUserId){
    $fileRew = $getUserId .'.json';

    $pathRew = "data/usersrequests/$fileRew";

    file_put_contents($pathRew, userUpdate($getUserId) . PHP_EOL);

}






