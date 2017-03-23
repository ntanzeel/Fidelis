<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentRecommendation extends Recommendation
{
    protected $fillable = [
        'user_id', 'content_recommendation', 'tag_id', 'response'
    ];
}
