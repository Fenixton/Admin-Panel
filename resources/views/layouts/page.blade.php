@extends('layouts.app')

@section('title')
@yield('title')
@endsection

@section('app_content')
<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">ToGo</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/">Панель управления</a>
                </li>
                @if (App\UserGroup::isAdmin(Auth::user()->user_group))
                <li><a href="/partners">Партнёры</a></li>
                <li><a href="/managers">Менеджеры</a></li>
                @endif
                @yield('menuitems')
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/logout">Выйти</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>
<div class="margin-top-1  margin-bottom-1 hidden-md"></div>
<footer class="container visible-md visible-lg">
    <p class="pull-right">
        <span>Разработка сайта и приложения: <a href="http://aspres.ru">Aspres Team</a> © 2017 ToGo</span>
    </p>
</footer>
@endsection