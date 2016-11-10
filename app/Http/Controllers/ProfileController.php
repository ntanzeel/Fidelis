<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {

    public function index() {
        return redirect()->route('profile.view', [Auth::user()->username]);
    }

    public function view($username) {
        $user = User::where('username', $username)->first();
        return view('profile.view', compact('user'));
    }

    public function followers($username) {
        $user = User::where('username', $username)->first();
        return view('profile.followers', compact('user'));
    }

    public function following($username) {
        $user = User::where('username', $username)->first();
        return view('profile.following', compact('user'));
    }
}
