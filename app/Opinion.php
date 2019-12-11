<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opinion extends Model
{
    //
    protected $fillable = [
        'opinion',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
