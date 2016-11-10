<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model {

    use SoftDeletes;

    protected $fillable = [
        'from_id', 'to_id', 'comment_id', 'notification', 'read',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
