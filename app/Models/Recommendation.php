<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $dates = [
        'deleted_at'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
