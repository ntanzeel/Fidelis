<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recommendation extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id', 'recommendation', 'response'
    ];

    protected  $hidden = [];

    public function user() {
        $this->belongsTo('App\Models\User');
    }
}
