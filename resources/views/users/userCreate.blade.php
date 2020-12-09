@extends('template')
@section('content')
<div class="main__center">
    <h1 class="align-center">Введите данные пользователя</h1>
    @if ($errors->any())
        <div class="error_form">
            <ul>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="contacts__form-group">
            <input value="{{old('login')}}" type="text" name="login" placeholder="login*">
        </div>
        <div class="contacts__form-group">
            <input value="{{old('name')}}"type="text" name="name" placeholder="Имя*">
        </div>
        <div class="contacts__form-group">
            <input value="{{old('surname')}}" type="text" name="surname" placeholder="Фамилия*">
        </div>
        <div class="contacts__form-group">
            <input value="{{old('email')}}" type="email" name="email" placeholder="Email*">
        </div>
        <div class="contacts__form-group">
            <input value="{{old('address')}}" type="text" name="address" placeholder="Адрес*">
        </div>
        <input  class="btn bcg-green font-white roboto" type="submit" name="web_form_submit" value="ОТПРАВИТЬ">
        <input type="hidden" name="submit" value="1">
    </form>
</div>
@endsection
