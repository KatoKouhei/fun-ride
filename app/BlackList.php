<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blacklist extends Model
{
    //
    protected $fillable = [
        'community_id',
        'user_id',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
