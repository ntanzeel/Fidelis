<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRecommendation extends Recommendation
{
    protected $fillable = [
        'user_id', 'user_recommendation', 'tag_id', 'response'
    ];
}
