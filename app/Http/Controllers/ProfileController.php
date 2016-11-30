<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {

    public function __construct() {
        $this->middleware('auth')->only('index');
    }

    /**
     * @param User $user
     * @return array|void
     */
    private function preRoute(User $user) {
        if (!Auth::user()) {
            return;
        }

        if ($user->blocked()->where('blocked_id', Auth::user()->id)->exists()) {
            abort(404);
        }

        Auth::user()->load(['blocked' => function ($query) use ($user) {
            $query->where('blocked_id', $user->id);
        }]);

        $isFollowing = Auth::user()->following()->where('following_id', $user->id)->exists();

        return ['isFollowing' => $isFollowing];
    }

    public function view(User $user) {
        $preRoute = $this->preRoute($user);

        $with = ['user', 'content'];

        if (Auth::user()) {
            $with['content.votes'] = function ($query) {
                $query->where('user_id', Auth::user()->id);
            };
        }

        $posts = $user->posts()->with($with)->latest()->get();

        return view('profile.view', array_merge(compact('user', 'posts'), $preRoute));
    }

    public function followers(User $user) {
        $preRoute = $this->preRoute($user);

        if (Auth::user()) {
            $user->load(['followers', 'followers.followers' => function ($query) {
                $query->where('follower_id', Auth::user()->id);
            }]);
        }

        return view('profile.followers', array_merge(compact('user'), $preRoute));
    }

    public function following(User $user) {
        $preRoute = $this->preRoute($user);

        if (Auth::user()) {
            $user->load(['following', 'following.followers' => function ($query) {
                $query->where('follower_id', Auth::user()->id);
            }]);
        }

        return view('profile.following', array_merge(compact('user'), $preRoute));
    }

    public function rated(User $user) {
        $this->preRoute($user);

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