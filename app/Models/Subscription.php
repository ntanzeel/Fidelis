<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id', 'tag_id',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function tag() {
        return $this->belongsTo('App\Models\Tag', 'tag_id');
    }
}
