<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategories extends Model {

    protected $table = "togo_menu_categories";
    protected $fillable = ['name'];
}