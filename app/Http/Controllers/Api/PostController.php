<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Traits\Post;
use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    use Post;

    public function __construct(Request $request) {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request) {
        $post = $this->add($request);
        return response()->view('posts.partials.feed-post', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Models\Post $post) {
        if (!$post->canBeViewedBy(Auth::user())) {
            abort(401);
        }

        return response()->json($post->load(['user', 'content', 'comments', 'images']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Models\Post $post) {
        if (!$post->canBeEditedBy(Auth::user())) {
            abort(401);
        }

        return response()->json($post->load(['user', 'content', 'comments', 'images']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        return response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Models\Post $post) {
        if (!$post->canBeEditedBy(Auth::user())) {
            abort(401);
        }

        return response()->json([
            'success' => $post->delete(),
        ]);
    }
}
