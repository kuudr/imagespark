<?php
$arrView = userView($getUserId);
?>
<table class="show_users">
    <tbody>
    <tr class="table_row">
        <th>Логин:</th>
        <td><?= $arrView[0]?></td>
    </tr>
    <tr class="table_row">
        <th>Имя:</th>
        <td><?= $arrView[1]?></td>
    </tr>
    <tr class="table_row">
        <th>Фамилия:</th>
        <td><?= $arrView[2]?></td>
    </tr>
    <tr class="table_row">
        <th>Email:</th>
        <td><?= $arrView[3]?></td>
    </tr>
    <tr class="table_row">
        <th>Адрес:</th>
        <td><?= $arrView[4]?></td>
    </tr>
    </tbody>
</table>


