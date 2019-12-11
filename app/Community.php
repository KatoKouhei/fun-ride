<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    //
    protected $fillable = [
        'image_path',
        'community_title',
        'community_subtitle',
        'community_manage',
        'description',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
