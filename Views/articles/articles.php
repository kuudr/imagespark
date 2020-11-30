<div class="main__center">
    <a class="btn" href="/articles/create/">Создать статью </a>
</div>
<table class="show_users">
    <tr class="table_line">
        <th>Название статьи</th>
        <th>Текст статьи</th>
        <th>Кем создано</th>
        <th>Дата создания</th>
        <th></th>
        <th></th>
    </tr>
<?php foreach ($articles as $article):?>
<tr class="table_row">
    <td><?= $article['article_name']?></td>
    <td><?= $article['text']?></td>
    <td><?= $article['created_by']?></td>
    <td><?= $article['created_at']?></td>
    <td>
       <a href="/article/<?php echo $article['id']?>/view/" class="btn-users">View</a>
        <a href="/article/<?php echo $article['id']?>/update/"
           class="btn-users">Update</a>
        <a  onclick="return confirm('Вы уверены, что хотите удалить данную статью?')" href="/article/<?= $article['id']?>/delete/" class="btn-users">Delete</a>
    </td>
    <?php endforeach;?>
</tr>
</table>
