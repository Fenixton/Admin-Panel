<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model {

    protected $table = "togo_restaurants";

    public function partner() {
        return $this->hasOne('App\Partner', 'id', 'partner_id');
    }
}