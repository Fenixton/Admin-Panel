<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {

    protected $table = "togo_working_schedule";
    protected $fillable = ['restaurant_id', 'weekday', 'fromTime', 'tillTime'];
}