<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Http\Traits\Post;
use App\Models;

class CommentController extends Controller {

    use Post;

    public function store(Models\Post $post, CommentRequest $request) {
        $this->addComment($post, $request, false);
        return response()->json(['success' => true]);
    }

    public function delete() {

    }
}
