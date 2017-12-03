@extends('layouts.page')

@section('title', 'Изменить ресторан')

@section('menuitems')
@endsection

@section('content')
<div class="administration-area well">
<form action="/partners/info/{{ $partner_id }}/restaurants/edit/{{ $restaurant->id }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Выберите город:</label>
        <select name="city_id">
            @foreach ($cities as $city) {
               <option value="{{ $city->id }}">{{ $city->name }}</option>;
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Адрес ресторана:</label>
        <textarea class="form-control" name="address" placeholder="Введите адрес ресторана">{{ $restaurant->address }}</textarea>
    </div>
    <div class="form-group">
        <label>Широта:</label>
        <textarea class="form-control" name="latitude" placeholder="Введите широту">{{ $restaurant->latitude }}</textarea>
    </div>
    <div class="form-group">
        <label>Долгота:</label>
        <textarea class="form-control" name="longitude" placeholder="Введите долготу">{{ $restaurant->longitude }}</textarea>
    </div>
    <div class="form-group">
        <label>Средний чек:</label>
        <input class="form-control" type="text" name="average_bill" value="{{ $restaurant->average_bill }}">
    </div>
    <div class="form-group">
        <label>Выберите менеджера ресторана:</label>
        <select name="manager_id">
            @foreach ($managers as $m) 
                @if ($manager_id == $m->id)
                    <option selected value="{{ $m->id }}">{{ $m->name }}</option>
                @else
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>
        Статус: Доступен<input class="form-control" type="checkbox" name="is_available" 
                               <?php
                                    if ($restaurant->status == "AVAILABLE")
                                    echo 'checked';
                                ?>
                               >
        </label>
    </div>
    <div class="form-group">
        <input type="submit" value="Изменить ресторан" class="btn btn-primary">
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