@extends('layouts.page')

@section('title', 'Изменить ресторан')

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
<div class="administration-area well">
<form action="/restaurant/{{ $id }}/edit" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Средний чек:</label>
        <input class="form-control" type="text" name="average_bill" value="{{ $restaurant->average_bill }}">
    </div>
    <div class="form-group">
        <input type="submit" value="Изменить" class="btn btn-primary">
    </div>
</form>    
</div> 

@endsection