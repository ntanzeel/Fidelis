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
     * @return \Illuminate\Http\Response
     */
    public function store(Models\Post $post, CommentRequest $request) {
        $comment = $this->addComment($post, $request, false);
        return response()->view('posts.partials.comment', compact('comment'));
    }

    /**
     * @param Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Models\Comment $comment) {
        if (!$comment->canBeEditedBy(Auth::user())) {
            abort(401);
        }

        return response()->json(['success' => $comment->delete()]);
    }
}
