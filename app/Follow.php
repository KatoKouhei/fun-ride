<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    //
    protected $fillable = [
        'follow_id',
        'follower_id',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
