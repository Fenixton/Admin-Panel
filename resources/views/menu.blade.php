@extends('layouts.page')

@section('title', 'Меню')

@section('menuitems')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Рестораны<b class="caret"></b></a>
    <ul class="dropdown-menu">
    @foreach ($allRestaurants as $rest)
        <li><a href="/restaurant/{{ $rest->id }}" title="Перейти на страницу ресторана">{{ $rest->address }}</a></li>
    @endforeach
    </ul>
</li>
@endsection

@section('content')

<div>
    <div class="vertical-align margin-bottom-1">
        @include('restaurant-chunk', ['restaurant' => $restaurant])
    </div>
    <div class="vertical-align margin-bottom-1">
    
        <div class="text-left row-phone">
            <h2>Меню</h2>
        </div>
        <div class="text-right row-phone">
            <a href="/restaurant/{{ $id }}/menu/add" title="Добавить товар" class="btn btn-phone btn-primary">Добавить товар</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="visible-lg hidden-xs"></th>
                    <th>Название</th>
                    <th class="visible-lg hidden-xs">Категория</th>
                    <th class="visible-lg hidden-xs">Цена</th>
                    <th class="visible-lg hidden-xs">Наличие</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($menu as $item)
                    <tr>
                    <td class="visible-lg hidden-xs">
                        @if($item->image_url != "")
                        <img src="{{ $item->image_url }}" style="width:auto;height:60px;"/>
                        @else
                        <img src="/resources/assets/img/menu-empty.png" style="width:auto;height:60px;"/>
                        @endif
                    </td>
                    <td class="visible-lg hidden-xs">{{ $item->name }}</td>
                    <td class="visible-lg hidden-xs">{{ $item->category->name }}</td>
                    <td class="visible-lg hidden-xs">
                        @if (empty(json_decode($item->options)))
                        {{ $item->price }} руб.
                        @endif    
                    </td>
                    <td class="visible-lg hidden-xs">
                        @if (empty(json_decode($item->options)))
                            @if($item->is_available) В наличии @else Отсутствует @endif
                        @endif 
                    </td>
                    <td>
                    <div class="pull-right">
                        <a href="/restaurant/{{ $id }}/menu/edit/{{ $item->id }}" class="btn btn-primary">Изменить</a>
                        <a href="/restaurant/{{ $id }}/menu/delete/{{ $item->id }}" class="btn btn-danger">Удалить</a>
                    </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="vertical-align margin-bottom-1">
    
        <div class="text-left row-phone">
            <h2>Топинги</h2>
        </div>
        <div class="text-right row-phone">
            <a href="/restaurant/{{ $id }}/menu/add_toping" title="Добавить топинг" class="btn btn-phone btn-primary">Добавить топинг</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Название</th>
                    <th class="visible-lg hidden-xs">Цена</th>
                    <th class="visible-lg hidden-xs">Наличие</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($topings as $tp)
                    <tr>
                    <td class="visible-lg hidden-xs">{{ $tp->name }}</td>
                    <td class="visible-lg hidden-xs">{{ $tp->price }} руб.</td>
                    <td class="visible-lg hidden-xs">
                    @if($tp->is_available) В наличии @else Отсутствует @endif
                    </td>
                    <td>
                    <div class="pull-right">
                        <a href="/restaurant/{{ $id }}/menu/edit_toping/{{ $tp->id }}" class="btn btn-primary">Изменить</a>
                        <a href="/restaurant/{{ $id }}/menu/delete_toping/{{ $tp->id }}" class="btn btn-danger">Удалить</a>
                    </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection