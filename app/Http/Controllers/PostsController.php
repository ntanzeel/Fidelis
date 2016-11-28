<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller {

    public function index() {

    }

    /**
     * @param User $user
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(User $user, Post $post) {
        $this->checkAccess($user, $post);

        $with = ['user'];

        if (Auth::user()) {
            $with['votes'] = function ($query) {
                $query->where('user_id', Auth::user()->id);
            };
        }

        $comments = $post->comments()->with($with)->get();

        return view('posts.view', compact('user', 'post', 'comments'));
    }

    private function checkAccess(User $user, Post $post) {
        if ($user->id != $post->user_id) {
            abort(404);
        }
        if (!$post->canBeViewedBy(Auth::user())) {
            abort(401);
        }
    }
}
