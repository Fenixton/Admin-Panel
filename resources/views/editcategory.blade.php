@extends('layouts.page')

@section('title', 'Изменить категорию')

@section('menuitems')
@endsection

@section('content')
<div class="administration-area well">
<form action="/partners/info/{{ $partner_id }}/menu_categories/edit/{{ $category->id }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Название категории:</label>
        <input class="form-control" type="text" name="name" value="{{ $category->name }}" placeholder="Введите название">
    </div>
    <div class="form-group">
        <input type="submit" value="Изменить категорию" class="btn btn-primary">
    </div>
    @if ($errors->has())
        <div class="form-group">
            <label>Были обнаружены следующие ошибки:</label>
            <ul>
                <?php echo implode('', $errors->all('<li>:message</li>')); ?>
            </ul>
        </div>
    @endif
@endsection