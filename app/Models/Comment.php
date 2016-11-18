<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed text
 */
class Comment extends Model {

    use SoftDeletes;

    protected $fillable = [
        'post_id', 'user_id', 'text', 'reputation', 'root',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function post() {
        return $this->hasOne('App\Models\Post');
    }

    public function htmlText() {
        $html =  preg_replace_callback('/#(\w+)/', function ($matches) {
            return '<a class="hash-tag" href="' . route('discover.category', [$matches[1]]) . '">' . $matches[0] . '</a>';
        }, $this->text);

        $html =  preg_replace_callback('/@(\w+)/', function ($matches) {
            return '<a class="mention-username" href="' . route('profile.view', [$matches[1]]) . '">' . $matches[0] . '</a>';
        }, $html);

        return $html;
    }
}
