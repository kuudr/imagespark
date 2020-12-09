@extends('template')
@section('content')
<table class="show_users">
    <tbody>
    <tr class="table_row">
        <th>Название статьи:</th>
        <td><?= $article['name']?></td>
    </tr>
    <tr class="table_row">
        <th>Текст статьи:</th>
        <td><?= $article['text']?></td>
    </tr>
    <tr class="table_row">
        <th>Кем создана статья:</th>
        <td><?= $article['created_by']?></td>
    </tr>
    <tr class="table_row">
        <th>Дата создания:</th>
        <td><?= $article['created_at']?></td>
    </tr>
    </tbody>
</table>
@endsection
