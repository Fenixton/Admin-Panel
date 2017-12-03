@extends('layouts.page')

@section('title', 'Добавить ресторан')

@section('menuitems')
@endsection

@section('content')
<div class="administration-area well">
<form action="/partners/info/{{ $partner_id }}/restaurants/add" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Выберите город:</label>
        <select name="city_id">
            @foreach ($cities as $city) 
               <option value="{{ $city->id }}">{{ $city->name }}</option>;
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Адрес ресторана:</label>
        <textarea class="form-control" name="address" placeholder="Введите адрес ресторана">{{ old('address') }}</textarea>
    </div>
    <div class="form-group">
        <label>Широта:</label>
        <textarea class="form-control" name="latitude" placeholder="Введите широту">{{ old('latitude') }}</textarea>
    </div>
    <div class="form-group">
        <label>Долгота:</label>
        <textarea class="form-control" name="longitude" placeholder="Введите долготу">{{ old('longitude') }}</textarea>
    </div>
    <div class="form-group">
        <label>Средний чек:</label>
        <input class="form-control" type="text" name="average_bill" value="{{ old('average_bill') }}">
    </div>
    <div class="form-group">
        <label>Выберите менеджера ресторана:</label>
        <select name="manager_id">
            @foreach ($managers as $m) 
                <option value="{{ $m->id }}">{{ $m->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>
        Статус: Доступен<input class="form-control" type="checkbox" name="is_available" checked>
        </label>
    </div>
    <div class="form-group">
        <input type="submit" value="Добавить ресторан" class="btn btn-primary">
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