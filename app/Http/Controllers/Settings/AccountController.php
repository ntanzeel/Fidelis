<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class AccountController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('profile.settings');
    }

    public function upload() {

    }
}
