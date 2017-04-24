<?php

namespace App\Models;

use App\Notifications;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;

/**
 * App\Models\Notification
 *
 * @property string $id
 * @property string $type
 * @property integer $notifiable_id
 * @property string $notifiable_type
 * @property string $data
 * @property string $read_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \App\Models\User $to
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $notifiable
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereNotifiableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereNotifiableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereReadAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Notification extends DatabaseNotification {

    use SoftDeletes;

    public function get($key) {
        return $this->keyExists($key) ? $this->data[$key] : false;
    }

    public function keyExists($key) {
        return isset($this->data[$key]);
    }

    public function to() {
        return $this->belongsTo('App\Models\User', 'notifiable_id');
    }

    public function from() {
        return $this->exists ?
            User::find($this->data['from']) : false;
    }

    public function regarding() {
        if ($this->exists) {
            switch ($this->type) {
                case Notifications\Mention::class:
                case Notifications\Comment::class:
                case Notifications\Vote::class:
                    return Comment::find($this->data['regarding']);
                case Notifications\Follow::class:
                case Notifications\PendingFollow::class:
                    return User::find($this->data['regarding']);
            }
        }

        return false;
    }

    public function getHtmlText() {
        return $this->exists ? preg_replace_callback('/@(\w+)/', function ($matches) {
            return '<a class="mention-username" href="' . route('profile.view', [$matches[1]]) . '">' . $matches[0] . '</a>';
        }, $this->data['text']) : false;
    }

    public function isComment() {
        return $this->type == Notifications\Comment::class;
    }

    public function isMention() {
        return $this->type == Notifications\Mention::class;
    }

    public function isFollow() {
        return $this->type == Notifications\Follow::class;
    }

    public function isVote() {
        return $this->type == Notifications\Vote::class;
    }

    public function isPendingFollow() {
        return $this->type == Notifications\PendingFollow::class;
}
}
