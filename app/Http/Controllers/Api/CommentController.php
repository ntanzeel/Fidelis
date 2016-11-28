<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Http\Traits\Post;
use App\Models;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    use Post;

    /**
     * @param Models\Post $post
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Models\Post $post, CommentRequest $request) {
        $comment = $this->addComment($post, $request, false);
        return response()->json(['success' => $comment->load('user')]);
    }

    public function delete() {

    }

    /**
     * @param Models\Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Models\Post $post) {
        if (!$post->canBeViewedBy(Auth::user())) {
            abort(401);
        }

        $comments = $post->comments;
        return view('posts.view', compact('post', 'comments'));
    }
}
