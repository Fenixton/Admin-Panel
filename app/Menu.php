<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
    protected $table = "togo_menu";

    public function category() {
        return $this->hasOne('App\MenuCategories', 'id', 'category_id');
    }
}