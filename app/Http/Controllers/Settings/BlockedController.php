<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class BlockedController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('settings.blocked.index', ['users' => \Auth::user()->blocked]);
    }
}
