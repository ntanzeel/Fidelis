<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Comment
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property string $text
 * @property integer $up_votes
 * @property integer $down_votes
 * @property boolean $root
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Post $post
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment wherePostId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereReputation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereRoot($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUpVotes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereDownVotes($value)
 * @mixin \Eloquent
 *
 */
class Comment extends Model {

    use SoftDeletes;

    protected $fillable = [
        'post_id', 'user_id', 'text', 'up_votes', 'down_votes', 'root', 'hidden',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function post() {
        return $this->belongsTo('App\Models\Post');
    }

    public function votes() {
        return $this->hasMany('App\Models\Vote');
    }

    public function htmlText() {
        $html = preg_replace_callback('/\B#(\w*[a-zA-Z]+\w*)/', function ($matches) {
            return '<a class="hash-tag" href="' . route('discover.category', [$matches[1]]) . '">' . $matches[0] . '</a>';
        }, $this->text);

        $html = preg_replace_callback('/@(\w+)/', function ($matches) {
            return '<a class="mention-username" href="' . route('profile.view', [$matches[1]]) . '">' . $matches[0] . '</a>';
        }, $html);

        return $html;
    }

    public function canBeEditedBy($user) {
        return $user && $this->user_id == $user->id;
    }
}
