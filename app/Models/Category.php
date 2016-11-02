<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {

    use SoftDeletes;

    protected $fillable = [
        'name', 'description',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function tags(){
        return $this->belongsToMany('App\Models\Tag')
            ->whereNull('category_tag.deleted_at')
            ->withPivot(['root', 'deleted_at'])
            ->withTimestamps()
            ->orderBy('category_tag.root', 'DESC');
    }
}
