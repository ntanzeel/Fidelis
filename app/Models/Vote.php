<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id', 'comment_id', 'type',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function user() {
        $this->belongsTo('App\Models\User');
    }
}
