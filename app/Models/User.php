<?php

namespace App\Models;

use App\Http\Traits\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed id
 * @property mixed private
 */
class User extends Authenticatable {

    use SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dob', 'reputation',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'deleted_at', 'dob',
    ];

    public function followers() {
        return $this->belongsToMany('App\Models\User', 'followers', 'following_id', 'follower_id')
            ->whereNull('followers.deleted_at')
            ->withPivot(['mutual', 'approved', 'deleted_at'])
            ->withTimestamps();
    }

    public function following() {
        return $this->belongsToMany('App\Models\User', 'followers', 'follower_id', 'following_id')
            ->whereNull('followers.deleted_at')
            ->withPivot(['mutual', 'approved', 'deleted_at'])
            ->withTimestamps();
    }

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }

    public function subscriptions() {
        return $this->belongsToMany('App\Models\Tag', 'subscriptions', 'user_id', 'tag_id')
            ->whereNull('subscriptions.deleted_at')
            ->withTimestamps();
    }

    public function follows(User $user) {
        return $user && $this->following()->where('following_id', $user->id)->exists();
    }

    public function followedBy(User $user) {
        return $user && $this->followers()->where('follower_id', $user->id)->exists();
    }
}