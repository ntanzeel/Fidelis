<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tag
 *
 * @property integer $id
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereDeletedAt($value)
 * @mixin \Eloquent
 */
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
