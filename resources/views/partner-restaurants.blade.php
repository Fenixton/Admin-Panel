@extends('layouts.page')

@section('title', 'Рестораны')

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
        <div class="text-right row-phone">
            <a href="/partners/info/{{ $partnerid }}/restaurants/add" title="Добавить партнёра" class="btn btn-phone btn-primary">Добавить ресторан</a>
        </div>
    </div>
    <div class="well dashboard-well">
        @foreach($restaurants as $rest)
            <div class="vertical-align margin-bottom-1">
                <div class="text-left row-phone">{{ $rest->address }}</div>
                <div class="text-right row-phone">
                    <a href="/restaurant/{{ $rest->id }}" title="Перейти на страницу ресторана" class="btn btn-phone btn-primary">Перейти</a>
                    <a href="/partners/info/{{ $partnerid }}/restaurants/edit/{{ $rest->id }}" title="Изменить" class="btn btn-phone btn-primary">Изменить</a>
                    <a href="/partners/info/{{ $partnerid }}/restaurants/delete/{{ $rest->id }}" title="Удалить" class="btn btn-phone btn-danger confirmDelete">Удалить</a>
                </div>
                </div>
        @endforeach
    </div>
</div>

@endsection