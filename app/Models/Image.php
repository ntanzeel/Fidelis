<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    protected $fillable = [
        'post_id', 'path',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
