<?php

//View User
function userView($getUserId){
    $userFileName = $getUserId .'.json';
    $userView = file_get_contents("data/usersrequests/$userFileName");
    $result = explode("\n", $userView);
    return $result;
}

//DeleteUser
function deleteUser($getUserId){
    $userFileDelete = $getUserId .'.json';

    $fileRemoveName = "data/usersrequests/$userFileDelete";

    if (file_exists($fileRemoveName)){
        unlink($fileRemoveName);
    }
}






