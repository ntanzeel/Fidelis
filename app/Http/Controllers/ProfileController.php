<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function likes(User $user) {
        $posts = Post::with('content')->whereHas('content.votes', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('profile.likes', compact('user', 'posts'));
    }
}
