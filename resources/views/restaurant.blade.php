@extends('layouts.page')

@section('title', 'Ресторан')

@section('menuitems')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Рестораны<b class="caret"></b></a>
    <ul class="dropdown-menu">
        @foreach($allRestaurants as $r)
            <li><a href="/restaurant/{{ $r->id }}" title="Перейти на страницу ресторана">{{ $r->address }}</a></li>
        @endforeach
    </ul>
</li>
@endsection

@section('content')
<div>
    <div class="well dashboard-well">
        <div class="vertical-align margin-bottom-1">
            <div class="form-group">
                <h1>{{ $restaurant->partner->name }}</h1>
                <img src="{{ $restaurant->partner->logo_url }}" width="250"/>
                <p>Адрес: {{ $cityName }}, {{ $restaurant->address }}</p>
                <p>Средний чек: {{ $restaurant->average_bill }} руб.</p>
                <div class="form-group">
                    @if ($restaurant->telegram_chat_id != "")
                        <label>Телеграм подключен</label>
                        <p><div class="btn btn-primary" id="telegramBtn" data-token="{{ $restaurant->telegram_token }}">Отправить тестовое сообщение</div></p>
                        <p><div class="btn btn-primary" id="unbindTelegram" data-token="{{ $restaurant->telegram_token }}">Отвязать</div></p>
                    @else
                        <label>Телеграм не подключен</label>
                        <p>
                            <span>Для подключения Телеграма:</span>
                            <ol>
                                <li>Найти ToGoBot (<a href="http://t.me/togoapp.bot" target="_blank">http://t.me/togoapp.bot</a>)</li>
                                <li>Отправить ему сообщение <code>/launch {{ $restaurant->telegram_token }}</code></li>
                            </ol>
                        </p>
                    @endif
                </div>
                <div class="text-right row-phone">
                    <a href="/restaurant/{{ $restaurant->id }}/menu" title="Меню" class="btn btn-phone btn-primary">Меню</a>
                    <a href="/restaurant/{{ $restaurant->id }}/schedule" title="График работы" class="btn btn-phone btn-primary">График работы</a>
                    <a href="/restaurant/{{ $restaurant->id }}/edit" title="Редактировать" class="btn btn-phone btn-primary">Редактировать информацию</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection