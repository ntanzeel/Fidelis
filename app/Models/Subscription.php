<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Subscription
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tag_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Models\Tag $tag
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subscription whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subscription whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subscription whereTagId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subscription whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Subscription extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id', 'tag_id',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function tag() {
        return $this->belongsTo('App\Models\Tag', 'tag_id');
    }

}
