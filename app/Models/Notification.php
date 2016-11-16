<?php

namespace App\Models;

use App\Notifications;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification {

    use SoftDeletes;

    public function keyExists($key) {
        return isset($this->data[$key]);
    }

    public function get($key) {
        return $this->keyExists($key) ? $this->data[$key] : false;
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
                    return User::find($this->data['regarding']);
            }
        }

        return false;
    }
}
