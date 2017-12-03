@extends('layouts.page')

@section('title', 'Партнёры')

@section('menuitems')
@endsection

@section('content')
<div>
    <div class="well dashboard-well">
        <div class="text-right row-phone">
            <a href="/partners/add" title="Добавить партнёра" class="btn btn-phone btn-primary">Добавить партнёра</a>
        </div>
    </div>
    <div class="well dashboard-well">
        @foreach($partners as $p)
            <div class="vertical-align margin-bottom-1">
                <div class="text-left row-phone">{{ $p->name }}</div>
                <div class="text-right row-phone">
                    <a href="/partners/info/{{ $p->id }}" title="Перейти на страницу партнёра" class="btn btn-phone btn-primary">Перейти</a>
                    <a href="/partners/edit/{{ $p->id }}" title="Изменить" class="btn btn-phone btn-primary">Изменить</a>
                    <a href="/partners/delete/{{ $p->id }}" title="Удалить" class="btn btn-phone btn-danger confirmDelete">Удалить</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection