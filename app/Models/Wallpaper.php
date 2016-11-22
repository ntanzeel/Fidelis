<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Wallpaper
 *
 * @property integer $id
 * @property string $path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Wallpaper whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Wallpaper wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Wallpaper whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Wallpaper whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Wallpaper whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Wallpaper extends Model {

    use SoftDeletes;

    protected $fillable = [
        'path',
    ];
}
