<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imagespark | CRUD</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Load Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="menu">
        <header>
            <nav class="menu_nav">
                <ul>
                    <li><a href="/" class="lnk">Главная</a></li>
                    <li><a href="/users" class="lnk">Пользователи</a></li>
                    <li><a href="/articles" class="lnk">Статьи</a></li>
                    <li><a href="/essence" class="lnk">Сущности</a></li>
                </ul>
                <form>
                    <button class="login_button">Войти</button>
                </form>
                <img class="logo" src="{{ asset('assets/img/logo.png') }}" alt="logo"/>
            </nav>
        </header>
    </div>
    @yield('content')
</div>
