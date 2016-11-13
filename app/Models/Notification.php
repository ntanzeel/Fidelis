<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model {

    use SoftDeletes;

    protected $fillable = [
        'from_id', 'to_id', 'comment_id', 'notification', 'read',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function from() {
        return $this->belongsTo('App\Models\User', 'from_id');
    }

    public function to() {
        return $this->belongsTo('App\Models\User', 'to_id');
    }

    public function comment() {
        return $this->belongsTo('App\Models\Comment');
//            ->where('root', false);
    }
}
