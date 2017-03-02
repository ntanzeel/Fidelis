<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRecommendation extends Model
{
    protected $fillable = [
        'user_id', 'user_recommendation', 'tag_id', 'response'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function user() {
        $this->belongsTo('App\Models\User');
    }
}
