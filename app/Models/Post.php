<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Post
 *
 * @property integer $id
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Comment $content
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function content() {
        return $this->hasOne('App\Models\Comment')
            ->where('root', true);
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment')
            ->where('root', false);
    }

    public function images() {
        return $this->hasMany('App\Models\Image');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag')
            ->whereNull('post_tag.deleted_at')
            ->withPivot(['deleted_at'])
            ->withTimestamps();
    }

    public function canBeViewedBy($user) {
        return !$this->user->is_private || ($user && ($this->user->followedBy($user) || $this->canBeEditedBy($user)));
    }

    public function canBeEditedBy($user) {
        return $user && $this->user_id == $user->id;
    }
}