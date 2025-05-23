<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules'; 

    protected $primaryKey = 'id_schedule'; 

    public $timestamps = false;

    protected $fillable = [
        'start_time',
        'end_time',
        'active_day',
        'scan_limit',
        'location'
    ];
}
