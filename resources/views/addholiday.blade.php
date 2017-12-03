@extends('layouts.page')

@section('title', 'Добавить праздничный день')

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
<form action="/restaurant/{{ $id }}/schedule/add_holiday" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
   <div class="form-group">
        <label>Выберите месяц:</label>
        <select name="month">
            <option value="1">Январь</option>
            <option value="2">Февраль</option>
            <option value="3">Март</option>
            <option value="4">Апрель</option>
            <option value="5">Май</option>
            <option value="6">Июнь</option>
            <option value="7">Июль</option>
            <option value="8">Август</option>
            <option value="9">Сентябрь</option>
            <option value="10">Октябрь</option>
            <option value="11">Ноябрь</option>
            <option value="12">Декабрь</option>
        </select>
    </div>
    <div class="form-group">
        <label>День:</label>
        <input class="form-control" type="number" name="day" value="{{ old('price') }}">
    </div>
    <div class="form-group">
            <label>Время открытия:</label><br>
            <label>Часы:</label>
            <input class="form-control" type="text" name="fromTimeH" placeholder="Введите время открытия, часы" value="{{ old('fromTimeH') }}">
            <label>Минуты:</label>
            <input class="form-control" type="text" name="fromTimeM" placeholder="Введите время открытия, минуты" value="{{ old('fromTimeM') }}">
        </div>
        <div class="form-group">
            <label>Время закрытия:</label><br>
            <label>Часы:</label>
            <input class="form-control" type="text" name="tillTimeH" placeholder="Введите время закрытия, часы" value="{{ old('tillTimeH') }}">
            <label>Минуты:</label>
            <input class="form-control" type="text" name="tillTimeM" placeholder="Введите время закрытия, минуты" value="{{ old('tillTimeM') }}">
        </div>
    <div class="form-group">
        <label>Коментарий:</label>
        <textarea class="form-control" name="comment" placeholder="Введите комментарий">{{ old('comment') }}</textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Добавить праздничный день" class="btn btn-primary">
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