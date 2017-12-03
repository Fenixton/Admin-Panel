@extends('layouts.page')

@section('title', 'Добавить товар')

@section('menuitems')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Рестораны<b class="caret"></b></a>
    <ul class="dropdown-menu">
    @foreach ($allRestaurants as $restaurant)
        <li><a href="/restaurant/{{ $restaurant->id }}" title="Перейти на страницу ресторана">{{ $restaurant->address }}</a></li>
    @endforeach
    </ul>
</li>
@endsection

@section('content')

<div class="administration-area well">
<form action="/restaurant/{{ $id }}/menu/add_toping" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Название топинга:</label>
        <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Введите название топинга">
    </div>
    <div class="form-group">
        <label>Цена топинга:</label>
        <input class="form-control" type="number" name="price" value="{{ old('price') }}">
    </div>
    <div class="form-group">
        <label>
        В наличии<input class="form-control" type="checkbox" name="is_available" checked>
        </label>
    </div>
    <div class="form-group">
        <input type="submit" value="Добавить товар" class="btn btn-primary">
    </div>
    @if ($errors->has())
        <div class="form-group">
            <label>Были обнаружены следующие ошибки:</label>
            <ul>
                <?php echo implode('', $errors->all('<li>:message</li>')); ?>
            </ul>
        </div>
    @endif
</form>    
</div> 

@endsection