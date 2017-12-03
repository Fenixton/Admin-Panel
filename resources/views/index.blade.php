@extends('layouts.page')

@section('title', 'Панель администратора')

@section('menuitems')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Рестораны<b class="caret"></b></a>
    <ul class="dropdown-menu">
        @foreach($restaurants as $r)
            <li><a href="/restaurant/{{ $r->id }}" title="Перейти на страницу ресторана">{{ $r->address }}</a></li>
        @endforeach
    </ul>
</li>
@endsection

@section('content')
<div>
    <div class="well dashboard-well">
        @foreach($restaurants as $r)
            <div class="vertical-align margin-bottom-1">
                <div class="text-left row-phone">{{ $r->address }}</div>
                <div class="text-right row-phone">
                    <a href="/restaurant/{{ $r->id }}" title="Перейти на страницу ресторана" class="btn btn-phone btn-primary">Перейти</a>
                    <a href="/restaurant/{{ $r->id}}/edit" title="Изменить" class="btn btn-phone btn-primary">Изменить</a>
                </div>
                </div>
        @endforeach
    </div>
</div>

@endsection