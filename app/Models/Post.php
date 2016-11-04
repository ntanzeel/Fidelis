<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function tags() {
        return $this->belongsToMany('App\Models\Tag')
            ->whereNull('post_tag.deleted_at')
            ->withPivot(['deleted_at'])
            ->withTimestamps();
    }

}