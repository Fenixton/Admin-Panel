<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantManager extends Model {

    protected $table = "togo_restaurant_manager";

    public function restaurant() {
        return $this->hasOne('App\Restaurant', 'id', 'restaurant_id');
    }
}