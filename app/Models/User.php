<?php

namespace App\Models;

use App\Http\Traits\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $reputation
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $dob
 * @property boolean $is_private
 * @property string $cover
 * @property string $photo
 * @property string $username
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $following
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $blocked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $subscriptions
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\App\Models\Notification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\App\Models\Notification[] $unreadNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\App\Models\Notification[] $readNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereReputation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDob($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsPrivate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePhoto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable {

    use SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'about', 'dob', 'reputation',
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

    protected $attributes = [
        'about' => '',
    ];

    public function __construct(array $attributes = []) {
        parent::__construct(array_merge(['api_token' => str_random(64)], $attributes));
    }

    public function getPhotoAttribute($value) {
        return asset(empty($value) ? 'assets/images/user/photo.png' : 'storage/' . $value);
    }

    public function getCoverAttribute($value) {
        return asset(empty($value) ? 'assets/images/user/cover.jpeg' : 'storage/' . $value);
    }

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }

    public function subscriptions() {
        return $this->belongsToMany('App\Models\Tag', 'subscriptions', 'user_id', 'tag_id')
            ->whereNull('subscriptions.deleted_at')
            ->withPivot(['id', 'deleted_at'])
            ->withTimestamps();
    }

    public function follows(User $user) {
        return $user && $this->following()->where('following_id', $user->id)->exists();
    }

    public function following() {
        return $this->belongsToMany('App\Models\User', 'followers', 'follower_id', 'following_id')
            ->whereNull('followers.deleted_at')
            ->withPivot(['id', 'mutual', 'approved', 'deleted_at'])
            ->withTimestamps();
    }

    public function blocked() {
        return $this->belongsToMany('App\Models\User', 'blocked', 'blocker_id', 'blocked_id')
            ->whereNull('blocked.deleted_at')
            ->withPivot(['id', 'deleted_at'])
            ->withTimestamps();
    }

    public function followedBy(User $user) {
        return $user && $this->followers()->where('follower_id', $user->id)->exists();
    }

    public function followers() {
        return $this->belongsToMany('App\Models\User', 'followers', 'following_id', 'follower_id')
            ->whereNull('followers.deleted_at')
            ->withPivot(['id', 'mutual', 'approved', 'deleted_at'])
            ->withTimestamps();
    }

    public function voted() {
        return Post::whereHas('content.votes', function ($query) {
            $query->where('user_id', $this->id);
        });
    }

    private function defaultSettings() {
        return DefaultSetting::leftJoin(
            \DB::raw(
                '(' . $this->settings()->toSql() . ') settings'
            ), 'default_settings.name', '=', 'settings.name')
            ->select(
                'settings.id AS id',
                \DB::raw('(CASE WHEN settings.user_id IS NULL THEN ? ELSE settings.user_id END) AS user_id'),
                'default_settings.name AS name',
                \DB::raw('(CASE WHEN settings.value IS NULL THEN default_settings.value ELSE settings.value END) AS value')
            );
    }

    public function settings() {
        return $this->hasMany('App\Models\Setting');
    }

    public function getSettingsAttribute() {
        if (!array_key_exists('settings', $this->relations)) {
            $settings = Setting::hydrateRaw($this->defaultSettings()->toSql(), [$this->id, $this->id])->keyBy('name');

            foreach ($settings->all() as $setting) {
                $setting->exists = !is_null($setting->id);
            }

            $this->setRelation('settings', $settings);
        }

        return $this->getRelation('settings');
    }

    public function uploadDirectory() {
        return md5($this->username . $this->created_at);
    }

    public function user_recommendations() {
        return $this->belongsToMany('App\Models\User', 'user_recommendations', 'user_id', 'user_recommendation')
            ->whereNull('user_recommendations.deleted_at')
            ->withPivot(['id', 'response', 'deleted_at'])
            ->withTimestamps();
    }

    public function content_recommendations() {
        return $this->belongsToMany('App\Models\User', 'content_recommendations', 'user_id', 'content_recommendation')
            ->whereNull('content_recommendations.deleted_at')
            ->withPivot(['id', 'response', 'deleted_at'])
            ->withTimestamps();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName() {
        return 'username';
    }
}