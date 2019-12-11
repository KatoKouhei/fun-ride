<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $fillable = [
        'user_id',
        'title',
        'map_url',
        'distance',
        'route',
        'location',
        'level',
        'meeting_at',
        'start_at',
        'end_at',
        'capacity',
        'model',
        'age',
        'detail',
        'prefecture',
        'load_type'
    ];
}
