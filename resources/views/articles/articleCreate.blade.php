@extends('template')
@section('content')
<div class="main__center">
    <h1 class="align-center">Введите данные статьи</h1>
    @if ($errors->any())
        <div class="error_form">
            <ul>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <div class="contacts__form-group">
            <input value=""type="hidden" name="id" placeholder="id">
        </div>
        <div class="contacts__form-group">
            <input value="{{old('name')}}"type="text" name="name" placeholder="Название статьи*">
        </div>
        <div class="contacts__form-group">
            <input value="{{old('text')}}" type="text" name="text" placeholder="Текст статьи*">
        </div>
        <div class="contacts__form-group">
            <input value="{{old('created_by')}}" type="text" name="created_by" placeholder="Кем создано*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
        <input type="hidden" name="article_create" value="1">
    </form>
</div>
@endsection
