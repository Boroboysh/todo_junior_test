<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title') </title>


    @vite(['resources/css/app.css'])
</head>
<body style="text-align: center">
<header class="header">
    @auth
        <div class="header-logout">
            <a href="{{route('logout')}}"> Выйти </a>
        </div>
    @endauth

    @guest
        <div><a href="{{route('login')}}"> Вход </a></div>
        <div><a href="{{route('register')}}"> Регистрация </a></div>
    @endguest
</header>
<section class="wrapper" style="text-decoration: none; color: black">
    @auth
        <section class="content-wrap">
            @yield('content')
        </section>
    @endauth
    @guest
        <h3>Todo - сервис для управления задачами</h3>
        @yield('guest-content')
    @endguest
</section>
</body>
</html>
