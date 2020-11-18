<?php
$checkErrors = new getFormInfo();
$checkErrors->checkOut();
class saveFile extends getFormInfo{

    public $login;
    protected $name;
    protected $surname;
    protected $email;
    protected $address;


    public static function saveFileFS($checkErrors){
        if ($checkErrors){
            echo 'TRUE';
        }
    }
}
