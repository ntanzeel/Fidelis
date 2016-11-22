<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Vote
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $comment_id
 * @property integer $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vote whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vote whereCommentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vote whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vote whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Vote extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id', 'comment_id', 'type',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function user() {
        $this->belongsTo('App\Models\User');
    }
}
