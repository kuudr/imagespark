<?php
//Валидация формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    if (mb_strlen($_POST['login']) == 0) {
        $errors[] = 'Не заполнен логин';
    } else {
        if (mb_strlen($_POST['login']) < 2) {
            $errors[] = 'Логин должен быть больше двух символов';
        }
    }
    if (mb_strlen($_POST['name']) == 0) {
        $errors[] = 'Не заполнено имя';
    } else {
        if (mb_strlen($_POST['name']) < 2) {
            $errors[] = 'Имя должно быть больше двух символов';
        }
    }
    if (mb_strlen($_POST['surname']) == 0) {
        $errors[] = 'Не заполнена фамилия';
    } else {
        if (mb_strlen($_POST['surname']) < 2) {
            $errors[] = 'Фамилия должна быть больше двух символов';
        }
    }
    if (mb_strlen($_POST['email']) == 0) {
        $errors[] = 'Не заполнен email';
    }
    if (mb_strlen($_POST['address']) == 0) {
        $errors[] = 'Не заполнен адрес';
    } else {
        if (mb_strlen($_POST['address']) < 10) {
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
        $login = strip_tags(addslashes($_POST['login']));
        $name = strip_tags(addslashes($_POST['name']));
        $surname = strip_tags(addslashes($_POST['surname']));
        $email = strip_tags(addslashes($_POST['email']));
        $address = strip_tags(addslashes($_POST['address']));
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
            <input value="<?php if (isset($_POST['login'])) echo $_POST['login'] ?>" type="text" name="login" placeholder="login*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($_POST['name'])) echo $_POST['name'] ?>"type="text" name="name" placeholder="Имя*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($_POST['surname'])) echo $_POST['surname'] ?>" type="text" name="surname" placeholder="Фамилия*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" type="email" name="email" placeholder="Email*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($_POST['address'])) echo $_POST['address'] ?>" type="text" name="address" placeholder="Адрес*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
    </form>
</div>
