<?php

namespace App\Http\Controllers;

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
        $with = ['user', 'content'];

        if (Auth::user()) {
            $with['content.votes'] = function ($query) {
                $query->where('user_id', Auth::user()->id);
            };
        }

        $posts = $user->posts()->with($with)->latest()->get();
        return view('profile.view', compact('user', 'posts'));
    }

    public function followers(User $user) {
        if (Auth::user()) {
            $user->load(['followers', 'followers.followers' => function ($query) {
                $query->where('follower_id', Auth::user()->id);
            }]);
        }
        return view('profile.followers', compact('user'));
    }

    public function following(User $user) {
        if (Auth::user()) {
            $user->load(['following', 'following.followers' => function ($query) {
                $query->where('follower_id', Auth::user()->id);
            }]);
        }

        return view('profile.following', compact('user'));
    }

    public function rated(User $user) {
        $with = ['user', 'content'];

        if (Auth::user()) {
            $with['content.votes'] = function ($query) {
                $query->where('user_id', Auth::user()->id);
            };
        }

        $posts = $user->voted()->with($with)->get();

        return view('profile.rated', compact('user', 'posts'));
    }
}
