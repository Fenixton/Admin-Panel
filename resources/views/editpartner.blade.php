@extends('layouts.page')

@section('title', 'Изменить партнёра')

@section('menuitems')
@endsection

@section('content')
<div class="administration-area well">
<form action="/partners/edit/{{ $partner->id }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Название партнёра:</label>
        <input class="form-control" type="text" name="name" value="{{ $partner->name }}" placeholder="Введите название">
    </div>
    <div class="form-group">
        <label>Описание партнёра:</label>
        <textarea class="form-control" name="description" placeholder="Введите описание">{{ $partner->description }}</textarea>
    </div>
    <div class="form-group">
        <label>Выберите изображение логотипа:</label>
        <input class="form-control" type="file" name="logo">
    </div>
    <div class="form-group">
        <label>Выберите изображение постера:</label>
        <input class="form-control" type="file" name="poster">
    </div>
    <div class="form-group">
        <label>Выберите изображение маркера:</label>
        <input class="form-control" type="file" name="marker">
    </div>
    <div class="form-group">
        <input type="submit" value="Сохранить изменения" class="btn btn-primary">
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