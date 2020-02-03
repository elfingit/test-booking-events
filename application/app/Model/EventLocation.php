<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    protected $casts = [
        'started_at'    => 'datetime',
        'end_at'    => 'datetime',
    ];
}
