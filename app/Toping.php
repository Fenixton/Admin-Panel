<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toping extends Model { 

    protected $table = "togo_toppings";
    protected $fillable = ['restaurant_id', 'name', 'price', 'is_available'];
}