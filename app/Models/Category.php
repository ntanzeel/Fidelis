<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Category
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model {

    use SoftDeletes;

    protected $fillable = [
        'name', 'description',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function tags() {
        return $this->belongsToMany('App\Models\Tag')
            ->whereNull('category_tag.deleted_at')
            ->withPivot(['root', 'deleted_at'])
            ->withTimestamps()
            ->orderBy('category_tag.root', 'DESC');
    }
}
