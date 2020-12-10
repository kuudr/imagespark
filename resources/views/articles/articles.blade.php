@extends('template')
@section('content')
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
@foreach ($articles as $article)
<tr class="table_row">
    <td>{{ $article->name }}</td>
    <td>{{ $article->text }}</td>
    <td>{{ $article->created_by }}</td>
    <td>{{ $article->created_at }}</td>
    <td>
       <a href="{{ route('articles.show',  $article->id) }}" class="btn-users">View</a>
        <a href="{{ route('articles.edit',  $article->id) }}"
           class="btn-users">Update</a>
        <form method="post" action =  "{{ route('articles.destroy',  $article->id) }}">
            @csrf
            @method('DELETE')
            <button  onclick="return confirm('Вы уверены, что хотите удалить данную статью?')" class="btn-users">Delete</button>
        </form>
    </td>
    @endforeach
</tr>
</table>
<div class="main__center">
    {{ $articles->links("pagination::bootstrap-4") }}
</div>
@endsection
