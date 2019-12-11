<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    //
    protected $fillable = [
        'event_id',
        'user_id',
        'role_type',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
