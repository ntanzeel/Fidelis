<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Image
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image wherePostId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Image extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id', 'post_id', 'path',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
