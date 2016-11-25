<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller {

    //
    public function index() {

    }

    public function view(User $user, Post $post) {
        if (($user->id != $post->user_id)) {
            abort(404);
        }

        if (!($post->canBeViewedBy(Auth::user()))) {
            abort(401);
        }

        $comments = $post->comments;

        return view('posts.view', compact('user', 'post', 'comments'));
    }
}
