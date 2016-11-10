<?php

namespace App\Http\Controllers;

class ProfileController extends Controller {

    public function index() {
        return view('profile.view');
    }

    public function view($username) {
        return view('profile.view');
    }

    public function followers($username) {
        return view('profile.view');
    }

    public function following($username) {
        return view('profile.view');
    }
}
