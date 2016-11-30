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
        /*
         * Use the Post trait to store the new comment using the comment
         * request object
         */
        $comment = $this->addComment($post, $request, false);

        /*
         * Return the comment view with the newly added comment
         */
        return response()->view('posts.partials.comment', compact('comment'));
    }

    /**
     * @param Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Models\Comment $comment) {
        /*
         * Before deleting the comment, first check if the user has the correct
         * authorisation to edit the comment. If not, return a 401 unauthorised
         * status code.
         */
        if (!$comment->canBeEditedBy(Auth::user())) {
            abort(401);
        }

        /*
         * If the user has authorisation, return a success message with the deleted
         * comment.
         */
        return response()->json(['success' => $comment->delete()]);
    }
}
