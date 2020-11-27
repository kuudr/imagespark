<div class="main__center">
    <h1 class="align-center">Обновить статью</h1>
    <form method="POST">
        <div class="contacts__form-group">
            <input value="<?= $article['article_name'] ?>" type="text" name="login" placeholder="login*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $article['text'] ?>"type="text" name="name" placeholder="Имя*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
        <input type="hidden" name="update_article" value="1">
    </form>
</div>


