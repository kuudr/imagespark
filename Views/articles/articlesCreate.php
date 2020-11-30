<?php
$errorStringUserAccess = '';
if (isset($errors)){
    foreach ($errors as $error){
        $errorStringUserAccess .= "<p class=\"error_form\" style =  \" color: red\">$error</p>";
    }
}
?>

<div class="main__center">
    <h1 class="align-center">Введите данные статьи</h1>
    <?= $errorStringUserAccess;?>
    <form method="POST">
        <div class="contacts__form-group">
            <input value=""type="hidden" name="id" placeholder="id">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($info['article_name'])) echo $info['article_name'] ?>"type="text" name="article_name" placeholder="Название статьи*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($info['text'])) echo $info['text'] ?>" type="text" name="text" placeholder="Текст статьи*">
        </div>
        <div class="contacts__form-group">
            <input value="<?php if (isset($info['created_by'])) echo $info['created_by'] ?>" type="text" name="created_by" placeholder="Кем создано*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
        <input type="hidden" name="article_create" value="1">
    </form>
</div>
