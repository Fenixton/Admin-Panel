@extends('layouts.page')

@section('title', 'Категории')

@section('menuitems')
@endsection

@section('content')
<div>
    <div class="well dashboard-well">
        <div class="text-right row-phone">
            <a href="/partners/info/{{ $partner_id }}/menu_categories/add" title="Добавить категорию" class="btn btn-phone btn-primary">Добавить категорию</a>
        </div>
    </div>
    <div class="well dashboard-well">
        @foreach($categories as $c)
            <div class="vertical-align margin-bottom-1">
                <div class="text-left row-phone">{{ $c->name }}</div>
                <div class="text-right row-phone">
                    <a href="/partners/info/{{ $partner_id }}/menu_categories/edit/{{ $c->id }}" title="Изменить" class="btn btn-phone btn-primary">Изменить</a>
                    <a href="/partners/info/{{ $partner_id }}/menu_categories/delete/{{ $c->id }}" title="Удалить" class="btn btn-phone btn-danger">Удалить</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection