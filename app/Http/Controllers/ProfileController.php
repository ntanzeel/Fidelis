<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller {

    public function __construct() {
        $this->middleware('auth')->only('index');
    }

    public function index() {
        return redirect()->route('profile.view', [Auth::user()->username]);
    }

    public function view(User $user) {
        $posts = $user->posts()->latest()->get();
        return view('profile.view', compact('user', 'posts'));
    }

    public function followers(User $user) {
        return view('profile.followers', compact('user'));
    }

    public function following(User $user) {
        return view('profile.following', compact('user'));
    }
}
