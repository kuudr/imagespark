@extends('template')
@section('content')
<div class="main__center">
    <h1 class="align-center">Обновить статью</h1>
    @if ($errors->any())
        <div class="error_form">
            <ul>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('articles.update', $article) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="contacts__form-group">
            <input value="<?= $article['name'] ?>" type="text" name="name" placeholder="Название*">
        </div>
        <div class="contacts__form-group">
            <input value="<?= $article['text'] ?>"type="text" name="text" placeholder="Текст*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
        <input type="hidden" name="update_article" value="1">
    </form>
</div>
@endsection
