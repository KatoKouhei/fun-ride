<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    
    protected $fillable = [
        'title',
        'comment',
        'post_id',
        'user_id'
    ];


    // public $comment = false;
    // public $timestamps = false;

}
