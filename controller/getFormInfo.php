<?php
class getFormInfo{
    public $formInfo;
    public function __construct()
    {
        $this->formInfo = $_POST;
        return $this->formInfo;
    }
    function getFormInfo(){
        return $this->formInfo;
    }
    public function checkOut(){
        $errors = [];
        if (isset($this->formInfo['login'])){
            switch ($this->formInfo){
                case count($this->formInfo) == 0:
                    $errors[] = 'Не заполнены поля';
                    break;
                case mb_strlen($this->formInfo['login']) < 2:
                    $errors[] =  'Логин должен быть больше трех символов';
                    break;
                case mb_strlen($this->formInfo['name']) <2:
                    $errors[] =  'Имя должно быть больше трех символов';
                    break;
                case mb_strlen($this->formInfo['surname']) <2:
                    $errors[] =  'Фамилия должна быть больше трех символов';
                    break;
                case mb_strlen($this->formInfo['address']) <2:
                    $errors[] =  'Адрес должен быть больше 10 символов';
                    break;
            }
        }if (count($errors) == 0){
            return true;
        }
    }
}

