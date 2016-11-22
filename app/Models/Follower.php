<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Follower
 *
 * @property integer $id
 * @property integer $follower_id
 * @property integer $following_id
 * @property boolean $approved
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property boolean $mutual
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Follower whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Follower whereFollowerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Follower whereFollowingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Follower whereApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Follower whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Follower whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Follower whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Follower whereMutual($value)
 * @mixin \Eloquent
 */
class Follower extends Model {

    use SoftDeletes;

    protected $fillable = [
        'follower_id', 'following_id',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
