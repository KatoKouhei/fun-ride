<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    //
    protected $fillable = [
        'community_id',
        'user_id',
        'role_type',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
