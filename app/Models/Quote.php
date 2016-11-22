<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Quote
 *
 * @property integer $id
 * @property string $text
 * @property string $by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Quote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Quote whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Quote whereBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Quote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Quote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Quote whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Quote extends Model {

    use SoftDeletes;

    protected $fillable = [
        'text', 'by',
    ];
}
