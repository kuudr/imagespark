<div class="main__center">
    <a class="btn" href="/users/create">Создать пользователя </a>
</div>
<table class="show_users">
    <tr class="table_line">
        <th>Логин</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Email</th>
        <th>Адрес</th>
        <th></th>
        <th></th>
    </tr>
<?php foreach ($users as $userView):?>
<tr class="table_row">
    <td><?= $userView['login']?></td>
    <td><?= $userView['name']?></td>
    <td><?= $userView['surname']?></td>
    <td><?= $userView['email']?></td>
    <td><?= $userView['address']?></td>
    <td>
        <a href="/user/<?php echo $userView['login']?>/view" class="btn-users">View</a>
        <a href="/user/<?php echo $userView['login']?>/update"
           class="btn-users">Update</a>
        <a  onclick="return confirm('Вы уверены, что хотите удалить пользователя?')" href="/user/<?= $userView['login']?>/delete" class="btn-users">Delete</a>
    </td>
    <?php endforeach;?>
</tr>
</table>


