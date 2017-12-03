@extends('layouts.page')

@section('title', 'Изменить товар')

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
<form action="/restaurant/{{ $id }}/menu/edit/{{ $item->id }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Название товара:</label>
        <input class="form-control" type="text" name="name" placeholder="Введите название товара" value="<?php echo $item->name; ?>">
    </div>
    <div class="form-group">
        <label>Описание товара:</label>
        <textarea class="form-control" name="description" placeholder="Введите описание товара"><?php echo $item->description; ?></textarea>
    </div>
    <div class="form-group">
        <label>Выберите категорию:</label>
        <select name="category_id">
            <?php 
            foreach ($categories as $category) {
                echo '<option value="',$category->id,'" ';
                if ($category->id == $item->category_id){
                    echo 'selected';
                }
                echo '>', $category->name, '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Цена товара:</label>
        <input class="form-control" type="number" name="price" value="<?php echo $item->price; ?>">
    </div>
    <div class="form-group">
        <label>
        В наличии<input class="form-control" type="checkbox" name="is_available"
                        <?php
                            if ($item->is_available == true)
                                echo 'checked';
                        ?>
                        >
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
                        <td><input class="form-control" type="number" name="options_volume_0" value="<?php if (count($options) >= 1) echo $options[0]['volume']; ?>"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_0" value="<?php if (count($options) >= 1) echo $options[0]['price']; ?>"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_0" <?php if(count($options) >= 1 && $options[0]['is_available'] == true) echo 'checked'; ?> ></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_1" value="<?php if (count($options) >= 2) echo $options[1]['volume']; ?>"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_1" value="<?php if (count($options) >= 2) echo $options[1]['price']; ?>"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_1" <?php if(count($options) >= 2 && $options[1]['is_available'] == true) echo 'checked'; ?>></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_2" value="<?php if (count($options) >= 3) echo $options[2]['volume']; ?>"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_2" value="<?php if (count($options) >= 3) echo $options[2]['price']; ?>"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_2" <?php if(count($options) >= 3 && $options[2]['is_available'] == true) echo 'checked'; ?>></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_3" value="<?php if (count($options) >= 4) echo $options[3]['volume']; ?>"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_3" value="<?php if (count($options) >= 4) echo $options[3]['price']; ?>"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_3" <?php if(count($options) >= 4 && $options[3]['is_available'] == true) echo 'checked'; ?>></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_4" value="<?php if (count($options) >= 5) echo $options[4]['volume']; ?>"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_4" value="<?php if (count($options) >= 5) echo $options[4]['price']; ?>"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_4" <?php if(count($options) >= 5 && $options[4]['is_available'] == true) echo 'checked'; ?>></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="number" name="options_volume_5" value="<?php if (count($options) == 6) echo $options[5]['volume']; ?>"></td>
                        <td class="visible-lg hidden-xs"><input class="form-control" type="number" name="options_price_5" value="<?php if (count($options) == 6) echo $options[5]['price']; ?>"></td>
                        <td  class="visible-lg hidden-xs"><input class="form-control" type="checkbox" name="options_available_5" <?php if(count($options) == 6 && $options[5]['is_available'] == true) echo 'checked'; ?>></td>
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
            @if (in_array($tp->id, $currtopings)) 
                    <tr><td>{{ $tp->name }}</td><td class="visible-lg hidden-xs"><input type="checkbox" name="topings[]" value="{{ $tp->id }}" checked></td></tr>
            @else
                <tr><td>{{ $tp->name }}</td><td class="visible-lg hidden-xs"><input type="checkbox" name="topings[]" value="{{ $tp->id }}"></td></tr>
            @endif
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