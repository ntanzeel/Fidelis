<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller {

    /**
     * @param User $user
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(User $user, Post $post) {
        $this->checkAccess($user, $post);

        $load = ['user', 'content', 'comments', 'comments.user'];

        if (Auth::user()) {
            $load = array_merge($load, array_fill_keys(['content.votes', 'comments.votes'], function ($query) {
                $query->where('user_id', Auth::user()->id);
            }));
        }

        $post->load($load);

        return view('posts.view', compact('user', 'post'));
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
