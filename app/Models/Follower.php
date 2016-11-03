<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follower extends Model {

    use SoftDeletes;

    protected $fillable = [
        'follower_id', 'following_id',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
