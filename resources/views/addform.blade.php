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
<form action="/restaurant/{{ $id }}/menu/add" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Название товара:</label>
        <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Введите название товара">
    </div>
    <div class="form-group">
        <label>Описание товара:</label>
        <textarea class="form-control" name="description" placeholder="Введите описание товара">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label>Выберите категорию:</label>
        <select name="category_id">
            @foreach ($categories as $category) {
               <option value="{{ $category->id }}">{{ $category->name }}</option>;
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Цена товара:</label>
        <input class="form-control" type="number" name="price" value="{{ old('price') }}">
    </div>
    <div class="form-group">
        <label>
        В наличии<input class="form-control" type="checkbox" name="is_available" checked>
        </label>
    </div>
    <div class="form-group">
        <label>Выберите изображение товара:</label>
        <input class="form-control" type="file" name="image">
    </div>
    <div class="form-group">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Объём, мл.</td>
                        <td class="visible-lg hidden-xs">Цена, руб.</td>
                        <td class="visible-lg hidden-xs">Наличие</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_0" value="{{ old('options_volume_0') }}"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_0" value="{{ old('options_price_0') }}"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_0" checked></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_1" value="{{ old('options_volume_1') }}"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_1" value="{{ old('options_price_1') }}"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_1" checked></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_2" value="{{ old('options_volume_2') }}"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_2" value="{{ old('options_price_2') }}"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_2" checked></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_3" value="{{ old('options_volume_3') }}"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_3" value="{{ old('options_price_3') }}"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_3" checked></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_4" value="{{ old('options_volume_4') }}"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_4" value="{{ old('options_price_4') }}"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_4" checked></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_5" value="{{ old('options_volume_5') }}"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_5" value="{{ old('options_price_5') }}"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_5" checked></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group">
        <label>Выберите доступные для товара топинги:</label>
        <div class="table-responsive">
        <table class="table table-bordered">
        @foreach ($topings as $tp) 
            <tr><td>{{ $tp->name }}</td><td class="visible-lg hidden-xs"><input type="checkbox" name="topings[]" value="{{ $tp->id }}" /></td></tr>
        @endforeach
        </table>
        </div>
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