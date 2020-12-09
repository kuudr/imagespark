@extends('template')
@section('content')
<table class="show_users">
    <tbody>
    <tr class="table_row">
        <th>Логин:</th>
        <td><?= $user['login']?></td>
    </tr>
    <tr class="table_row">
        <th>Имя:</th>
        <td><?= $user['name']?></td>
    </tr>
    <tr class="table_row">
        <th>Фамилия:</th>
        <td><?= $user['surname']?></td>
    </tr>
    <tr class="table_row">
        <th>Email:</th>
        <td><?= $user['email']?></td>
    </tr>
    <tr class="table_row">
        <th>Адрес:</th>
        <td><?= $user['address']?></td>
    </tr>
    </tbody>
</table>
@endsection
