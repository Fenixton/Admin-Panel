@extends('layouts.page')

@section('title', 'Добавить менеджера')

@section('menuitems')

@endsection

@section('content')
<div class="administration-area well">
<form action="/managers/add" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Имя менеджера:</label>
        <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Введите имя менеджера">
    </div>
    <div class="form-group">
        <label>Email менеджера:</label>
        <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Введите email менеджера">
    </div>
    <div class="form-group">
        <label>Пароль менеджера:</label>
        <input class="form-control" type="text" name="password" value="{{ old('password') }}" placeholder="Введите пароль менеджера">
    </div>
    <div class="form-group">
        <input type="submit" value="Добавить менеджера" class="btn btn-primary">
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