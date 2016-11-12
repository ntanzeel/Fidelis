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

    public function post() {
        return $this->hasOne('App\Models\Post');
    }

    public function htmlText() {
        return preg_replace_callback('/#(\w+)/', function($matches) {
            return '<a href="' . route('discover.category', [$matches[1]]) . '">' . $matches[0] . '</a>';
        }, $this->text);
    }
}
