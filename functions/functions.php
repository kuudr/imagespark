<?php
//View User
function userView($getUserId){
    $userFileName = $getUserId .'.json';
    $userView = file_get_contents("data/usersrequests/$userFileName");
    $result = explode("\n", $userView);
    return $result;
}

//Delete User
function deleteUser($getUserId){
    $userFileDelete = $getUserId .'.json';
    $fileRemoveName = "data/usersrequests/$userFileDelete";
    if (file_exists($fileRemoveName)){
        unlink($fileRemoveName);
    }
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




//DD
function dd($var) {
    var_dump($var);
    die();
}



