<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    //
    protected $fillable = [
        'community_id',
        'title',
        'subtitle',
        'image_path',
        'description',
        'map_url',
        'prefecture',
        'route',
        'load_type',
        'distance',
        'level',
        'location',
        'start_at',
        'end_at',
        'meeting_at',
        'capacity',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
