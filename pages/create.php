<?php
namespace Controller;
//Валидация формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formInfo = Router::getInstance()->getFormInfo();
    $errors = [];
    if (mb_strlen($formInfo['login']) == 0) {
        $errors[] = 'Не заполнен логин';
    } else {
        if (mb_strlen($formInfo['login']) < 2) {
            $errors[] = 'Логин должен быть больше двух символов';
        }
    }
    if (mb_strlen($formInfo['name']) == 0) {
        $errors[] = 'Не заполнено имя';
    } else {
        if (mb_strlen($formInfo['name']) < 2) {
            $errors[] = 'Имя должно быть больше двух символов';
        }
    }
    if (mb_strlen($formInfo['surname']) == 0) {
        $errors[] = 'Не заполнена фамилия';
    } else {
        if (mb_strlen($formInfo['surname']) < 2) {
            $errors[] = 'Фамилия должна быть больше двух символов';
        }
    }
    if (mb_strlen($formInfo['email']) == 0) {
        $errors[] = 'Не заполнен email';
    }
    if (mb_strlen($formInfo['address']) == 0) {
        $errors[] = 'Не заполнен адрес';
    } else {
        if (mb_strlen($formInfo['address']) < 10) {
            $errors[] = 'Адрес должен быть больше десяти символов';
        }
    }
    if (count($errors) > 0) {
        $errorStringUserAccess = '';
        foreach ($errors as $error) {
            $errorStringUserAccess .= "<p class=\"error_form\" style =  \" color: red\">$error</p>";
        }
    }
    else {
        $login = strip_tags(addslashes($formInfo['login']));
        $name = strip_tags(addslashes($formInfo['name']));
        $surname = strip_tags(addslashes($formInfo['surname']));
        $email = strip_tags(addslashes($formInfo['email']));
        $address = strip_tags(addslashes($formInfo['address']));
        $eol = PHP_EOL;
        $fileNameUsers =  $login . '.json';
        $resultUserRequest = "{$login}{$eol}{$name}{$eol}{$surname}{$eol}{$email}{$eol}{$address}";
        file_put_contents("data/usersrequests/$fileNameUsers",$resultUserRequest, FILE_APPEND);
    }
}

?>
<div class="main__center">
    <h1 class="align-center">Введите данные пользователя</h1>
    <?php if (isset($errorStringUserAccess)){
        echo $errorStringUserAccess;
        $errorStringUserAccess .= "<p class=\"error_form\" style =  \" color: red\">$error</p>";
    }
    ?>

    <form method="POST">
        <div class="contacts__form-group">
            <input value="<?php if (isset($formInfo['login'])) echo $formInfo['login'] ?>" type="text" name="login" placeholder="login*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($formInfo['name'])) echo $formInfo['name'] ?>"type="text" name="name" placeholder="Имя*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($formInfo['surname'])) echo $formInfo['surname'] ?>" type="text" name="surname" placeholder="Фамилия*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($formInfo['email'])) echo $formInfo['email'] ?>" type="email" name="email" placeholder="Email*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($formInfo['address'])) echo $formInfo['address'] ?>" type="text" name="address" placeholder="Адрес*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
    </form>
</div>

