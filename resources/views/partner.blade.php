@extends('layouts.page')

@section('title', 'Партнёр')

@section('menuitems')
@endsection

@section('content')
<div>
    <div class="well dashboard-well">
        <div class="vertical-align margin-bottom-1">
            <div class="form-group">
                <h1>{{ $partner->name }}</h1>
                <img src="{{ $partner->logo_url }}" width="250"/>
                <p>{{ $partner->description }}</p>
                <div class="text-right row-phone">
                    <a href="/partners/info/{{ $partner->id}}/restaurants" title="Список ресторанов партнёра" class="btn btn-phone btn-primary">Список ресторанов</a>
                    <a href="/partners/info/{{ $partner->id}}/menu_categories" title="Список категорий партнёра" class="btn btn-phone btn-primary">Список категорий</a>
                    <a href="/partners/edit/{{ $partner->id }}" title="Редактировать" class="btn btn-phone btn-primary">Редактировать информацию</a>
                    <a href="/partners/delete/{{ $partner->id }}" title="Удфлить" class="btn btn-phone btn-danger">Удалить</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection