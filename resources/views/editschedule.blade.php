@extends('layouts.page')

@section('title', 'Изменить расписание')

@section('menuitems')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Рестораны<b class="caret"></b></a>
    <ul class="dropdown-menu">
    <?php
        foreach ($allRestaurants as $restaurant) {
            echo '<li><a href="/restaurant/',$restaurant->id,'" title="Перейти на страницу ресторана">',$restaurant->address,'</a></li>';
        }    
    ?>
    </ul>
</li>
@endsection

@section('content')
<div class="administration-area well">
    <form action="/restaurant/{{ $id }}/schedule/edit/{{ $weekday->weekday }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Время открытия:</label><br>
            <label>Часы:</label>
            <input class="form-control" type="text" name="fromTimeH" placeholder="Введите время открытия, часы" value="<?php echo $weekday->fromTime / 60 % 24; ?>">
            <label>Минуты:</label>
            <input class="form-control" type="text" name="fromTimeM" placeholder="Введите время открытия, минуты" value="<?php echo $weekday->fromTime % 60; ?>">
        </div>
        <div class="form-group">
            <label>Время закрытия:</label><br>
            <label>Часы:</label>
            <input class="form-control" type="text" name="tillTimeH" placeholder="Введите время закрытия, часы" value="<?php echo $weekday->tillTime / 60 % 24; ?>">
            <label>Минуты:</label>
            <input class="form-control" type="text" name="tillTimeM" placeholder="Введите время закрытия, минуты" value="<?php echo $weekday->tillTime % 60; ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection