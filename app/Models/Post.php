<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property int user_id
 * @property User user
 * @property Comment content
 * @property Collection comments
 * @property Collection tags
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

    public function tags() {
        return $this->belongsToMany('App\Models\Tag')
            ->whereNull('post_tag.deleted_at')
            ->withPivot(['deleted_at'])
            ->withTimestamps();
    }

    public function canBeViewedBy(User $user) {
        return !$this->user->private || ($user && ($this->user->followedBy($user) || $this->canEdit($user)));
    }

    public function canBeEditedBy(User $user) {
        return $user && $this->user_id == $user->id;
    }
}