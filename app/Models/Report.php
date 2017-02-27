<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model {

    use SoftDeletes;

    protected $fillable = ['user_id', 'comment_id', 'processed'];

    public function comment() {
        return $this->belongsTo('App\Models\Comment');
    }
}
