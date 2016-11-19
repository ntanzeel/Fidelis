<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Traits\Post;

class PostsController extends Controller {

    use Post;

    public function index() {

    }

    /**
     * Create a new post.
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request) {
        $this->add($request);
        return redirect()->route('home.index');
    }

}
