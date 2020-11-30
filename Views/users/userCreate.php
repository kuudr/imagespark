<?php
$errorStringUserAccess = '';
if (isset($errors)){
    foreach ($errors as $error){
        $errorStringUserAccess .= "<p class=\"error_form\" style =  \" color: red\">$error</p>";
    }
}
?>
<div class="main__center">
    <h1 class="align-center">Введите данные пользователя</h1>
    <?= $errorStringUserAccess;?>
    <form method="POST">
        <div class="contacts__form-group">
            <input value="<?php if (isset($info['login'])) echo $info['login'] ?>" type="text" name="login" placeholder="login*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($info['name'])) echo $info['name'] ?>"type="text" name="name" placeholder="Имя*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($info['surname'])) echo $info['surname'] ?>" type="text" name="surname" placeholder="Фамилия*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($info['email'])) echo $info['email'] ?>" type="email" name="email" placeholder="Email*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($info['address'])) echo $info['address'] ?>" type="text" name="address" placeholder="Адрес*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
        <input type="hidden" name="submit" value="1">
    </form>
</div>

