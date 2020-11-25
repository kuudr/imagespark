<div class="main__center">
    <h1 class="align-center">Обновить пользователя </h1>
    <form method="POST">
        <div class="contacts__form-group">
            <input value="<?= $user['login'] ?>" type="text" name="login" placeholder="login*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $user['name'] ?>"type="text" name="name" placeholder="Имя*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $user['surname'] ?>" type="text" name="surname" placeholder="Фамилия*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $user['email'] ?>" type="email" name="email" placeholder="Email*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $user['address'] ?>" type="text" name="address" placeholder="Адрес*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
        <input type="hidden" name="update" value="1">
    </form>
</div>


<!--<main>-->
<!--    <div class="main__center">-->
<!--        <div class="main__center">-->
<!--            <div class="main__center-smallbox">-->
<!--                <h1 class="h1-red">Пользователь обновлен!</h1>-->
<!--                <input  type="hidden">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</main>-->
<?php //endif; ?>


