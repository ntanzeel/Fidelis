<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {

    use SoftDeletes;

    protected $fillable = [
        'text',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function categories() {
        return $this->belongsToMany('App\Models\Category')
            ->whereNull('category_tag.deleted_at')
            ->withPivot(['root', 'deleted_at'])
            ->withTimestamps()
            ->orderBy('category_tag.root', 'DESC');
    }

    public function posts() {
        return $this->belongsToMany('App\Models\Post')
            ->whereNull('post_tag.deleted_at')
            ->withPivot(['deleted_at'])
            ->withTimestamps();
    }
}
