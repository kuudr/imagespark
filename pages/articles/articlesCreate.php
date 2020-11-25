<?php
//$errorStringUserAccess = '';
//if (isset($errors)){
//    foreach ($errors as $error){
//        $errorStringUserAccess .= "<p class=\"error_form\" style =  \" color: red\">$error</p>";
//    }
//}
//?>
<div class="main__center">
    <h1 class="align-center">Введите данные статьи</h1>
<!--    --><?//= $errorStringUserAccess;?>
    <form method="POST">
        <div class="contacts__form-group">
            <input value="<?php if (isset($formInfo['article'])) echo $formInfo['article'] ?>"type="text" name="article" placeholder="Название статьи*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($formInfo['text'])) echo $formInfo['text'] ?>" type="text" name="text" placeholder="Текст статьи*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
        <input type="hidden" name="article" value="1">
    </form>
</div>

