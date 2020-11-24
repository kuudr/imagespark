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

