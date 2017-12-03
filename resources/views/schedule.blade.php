@extends('layouts.page')

@section('title', 'Расписание')

@section('menuitems')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Рестораны<b class="caret"></b></a>
    <ul class="dropdown-menu">
    <?php
        foreach ($allRestaurants as $rest) {
            echo '<li><a href="/restaurant/',$rest->id,'" title="Перейти на страницу ресторана">',$rest->address,'</a></li>';
        }    
    ?>
    </ul>
</li>
@endsection

@section('content')
<div>
    @include('restaurant-chunk', ['restaurant' => $restaurant])
    <div class="vertical-align margin-bottom-1">
        <div class="text-left row-phone">
            <h2>Расписание</h2>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>День недели</th>
                    <th class="visible-lg hidden-xs">Открытие</th>
                    <th class="visible-lg hidden-xs">Закрытие</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($weekdays as $item_id => $item)
                    <tr>
                        <td class="visible-lg hidden-xs">{{ $item['name'] }}</td>
                        @if(isset($item['fromTime']) && isset($item['tillTime']))
                        <td class="visible-lg hidden-xs">{{ $item['fromTime'] / 60 % 24 }}:{{ $item['fromTime'] % 60 }}<?php if ($item['fromTime'] % 60 == 0) { echo '0'; } ?></td>
                        <td class="visible-lg hidden-xs">{{ $item['tillTime'] / 60 % 24 }}:{{ $item['tillTime'] % 60 }}<?php if ($item['tillTime'] % 60 == 0) { echo '0'; } ?></td>
                        @else
                        <td class="visible-lg hidden-xs">Не работает</td>
                        <td class="visible-lg hidden-xs">Не работает</td>
                        @endif
                        <td>
                            <div class="pull-right">
                                <a href="/restaurant/{{ $id }}/schedule/edit/{{ $item_id }}" class="btn btn-primary">Изменить</a>
                                @if(isset($item['fromTime']) && isset($item['tillTime']))
                                <a href="/restaurant/{{ $id }}/schedule/delete/{{ $item_id }}" class="btn btn-warning">Закрыто</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="vertical-align margin-bottom-1">
        <div class="text-left row-phone">
            <h2>Праздничные дни</h2>
        </div>
        <div class="text-right row-phone">
            <a href="/restaurant/{{ $id }}/schedule/add_holiday" title="Добавить праздницчный день" class="btn btn-phone btn-primary">Добавить праздничный день</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Месяц</th>
                    <th class="visible-lg hidden-xs">День</th>
                    <th class="visible-lg hidden-xs">Открытие</th>
                    <th class="visible-lg hidden-xs">Закрытие</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($calendar as $day) {
                    echo '<tr>';
                    echo '<td class="visible-lg hidden-xs">',$months[$day->month],'</td>';
                    echo '<td class="visible-lg hidden-xs">',$day->day,'</td>';
                    echo '<td class="visible-lg hidden-xs">',($day->fromTime) / 60 % 24, ':',($day->fromTime) % 60;
                    if (($day->fromTime) % 60 == 0) echo '0'; 
                    echo '</td>';
                    echo '<td class="visible-lg hidden-xs">',(($day->tillTime) / 60) % 24,':',($day->tillTime) % 60;
                    if (($day->tillTime) % 60 == 0) echo '0'; 
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="pull-right">';
                    echo '<a href="/restaurant/',$id,'/schedule/delete_holiday/',$day->id,'" class="btn btn-danger">Удалить</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
@endsection