<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Traits\Post;
use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;

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
        dd(1);
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

    public function predict(Models\Post $post){
        if (!$post->canBeEditedBy(Auth::user())) {
            abort(401);
        }
        $process = new Process('cd '.base_path('scripts/Categorisation').'; python predict.py "'. $post->content->text .'"');
        $process->run();
        $category = $process->getOutput();
        if ($category != -1){
            $categoryName = substr($category,0,-1);
            $tag = Models\Tag::where('text', $categoryName)->first();
            $post->tags()->attach($tag, ['automatic' => 1]);
            $tagId = $tag->id;
        }
        else {
            $tagId = 0;
            $categoryName = 'No category';
        }
        return response()->json(['name' => $categoryName,
                                 'id'   => $tagId]);
    }

    public function editCategory(Request $request) {
        $post = Models\Post::find($request->input('post'));
        if ($request->input('category') == 0) {
            $post->tags()->detach($post->automaticTag->first());
            return response()->json(['name' => 'No category',
                                     'id'   => 0]);
        }
        $category = Models\Category::find($request->input('category'));
        $tag = Models\Tag::where('text', $category->name)->first();
        $post->tags()->detach($post->automaticTag->first());
        $post->tags()->attach($tag->id, ['automatic' => 1]);
        return response()->json(['name' => $category->name,
                                 'id'   => $tag->id]);
    }
}
