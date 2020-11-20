<?php
$usersShow = new usersModel();
var_dump($usersShow->getUsers());


?>
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
<?php
    $filesUsers = scandir('./data/usersrequests/');
?>
<?php foreach ($filesUsers as $fileUserName):?>
<?php $result = ("data/usersrequests/$fileUserName");?>

<?php if(is_file($result)):?>
<?php $result = file("data/usersrequests/$fileUserName"); ?>
    <?php $allUserView = array_combine($keysUserView, $result);?>
<tr class="table_row">
    <td><?= $allUserView['login']?></td>
    <td><?= $allUserView['name']?></td>
    <td><?= $allUserView['surname']?></td>
    <td><?= $allUserView['email']?></td>
    <td><?= $allUserView['address']?></td>
    <td>
        <a href="/user/<?php echo $allUserView['login']?>/view" class="btn-users">View</a>
        <a href="/user/<?php echo $allUserView['login']?>/update"
           class="btn-users">Update</a>
        <a  onclick="return confirm('Вы уверены, что хотите удалить пользователя?')" href="/user/<?php echo $result[0]?>/delete" class="btn-users">Delete</a>
    </td>
</tr>
    <?php endif;?>
    <?php endforeach;?>
</table>


