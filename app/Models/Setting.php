<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model {

    use SoftDeletes;

    protected $fillable = ['user_id', 'name', 'value'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
