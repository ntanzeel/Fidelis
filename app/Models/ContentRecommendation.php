<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentRecommendation extends Model
{
    protected $fillable = [
        'user_id', 'content_recommendation', 'tag_id', 'response'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function user() {
        $this->belongsTo('App\Models\User');
    }
}
