@extends('layouts.page')

@section('title', 'Менеджеры')

@section('menuitems')
@endsection

@section('content')
<div>
    <div class="well dashboard-well">
        <div class="text-right row-phone">
            <a href="/managers/add" title="Добавить менеджера" class="btn btn-phone btn-primary">Добавить менеджера</a>
        </div>
    </div>
    <div class="well dashboard-well">
        @foreach($managers as $m)
            <div class="vertical-align margin-bottom-1">
                <div class="text-left row-phone">{{ $m->name }}</div>
                <div class="text-right row-phone">
                    <a href="/managers/edit/{{ $m->id }}" title="Изменить" class="btn btn-phone btn-primary">Изменить</a>
                    <a href="/managers/delete/{{ $m->id }}" title="Удалить" class="btn btn-phone btn-danger">Удалить</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection