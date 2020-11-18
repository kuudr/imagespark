<?php
//Валидация формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formArr =  $_POST;
    $errors = [];
    if (mb_strlen($formArr['login']) == 0) {
        $errors[] = 'Не заполнен логин';
    } else {
        if (mb_strlen($formArr['login']) < 2) {
            $errors[] = 'Логин должен быть больше двух символов';
        }
    }
    if (mb_strlen($formArr['name']) == 0) {
        $errors[] = 'Не заполнено имя';
    } else {
        if (mb_strlen($formArr['name']) < 2) {
            $errors[] = 'Имя должно быть больше двух символов';
        }
    }
    if (mb_strlen($formArr['surname']) == 0) {
        $errors[] = 'Не заполнена фамилия';
    } else {
        if (mb_strlen($formArr['surname']) < 2) {
            $errors[] = 'Фамилия должна быть больше двух символов';
        }
    }
    if (mb_strlen($formArr['email']) == 0) {
        $errors[] = 'Не заполнен email';
    }
    if (mb_strlen($formArr['address']) == 0) {
        $errors[] = 'Не заполнен адрес';
    } else {
        if (mb_strlen($formArr['address']) < 10) {
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
        $login = strip_tags(addslashes($formArr['login']));
        $name = strip_tags(addslashes($formArr['name']));
        $surname = strip_tags(addslashes($formArr['surname']));
        $email = strip_tags(addslashes($formArr['email']));
        $address = strip_tags(addslashes($formArr['address']));
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
            <input value="<?php if (isset($formArr['login'])) echo $formArr['login'] ?>" type="text" name="login" placeholder="login*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($formArr['name'])) echo $formArr['name'] ?>"type="text" name="name" placeholder="Имя*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($formArr['surname'])) echo $formArr['surname'] ?>" type="text" name="surname" placeholder="Фамилия*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($formArr['email'])) echo $formArr['email'] ?>" type="email" name="email" placeholder="Email*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($formArr['address'])) echo $formArr['address'] ?>" type="text" name="address" placeholder="Адрес*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
    </form>
</div>
