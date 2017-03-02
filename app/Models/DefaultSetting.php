<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefaultSetting extends Model {

    use SoftDeletes;

    protected $fillable = ['setting_id', 'value'];
}
