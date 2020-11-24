<?php


?>

<div class="main__center">
    <h1 class="align-center">Обновить пользователя </h1>
    <form method="POST">
        <div class="contacts__form-group">
            <input value="<?= $arrUpdateUser['login'] ?>" type="text" name="login" placeholder="login*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $arrUpdateUser['name'] ?>"type="text" name="name" placeholder="Имя*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $arrUpdateUser['surname'] ?>" type="text" name="surname" placeholder="Фамилия*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $arrUpdateUser['email'] ?>" type="email" name="email" placeholder="Email*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $arrUpdateUser['address'] ?>" type="text" name="address" placeholder="Адрес*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
    </form>
</div>
<?php


