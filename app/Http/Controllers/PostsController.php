<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller {

    public function store(PostRequest $request) {
        preg_match_all('/#(\w+)/', $request->get('text'), $tags);
        $tags = empty($tags) ? [] : $tags[1];

        $post = Auth::user()->posts()->save(new Post());
        $post->comments()->save(new Comment([
            'user_id'       => Auth::user()->id,
            'text'       => $request->get('text'),
            'reputation'    => 0,
            'root'          => 1
        ]));

        foreach ($tags as $tag) {
            $post->tags()->attach(Tag::firstOrCreate(['text' => $tag]));
        }

        return redirect()->route('home.index');
    }

}
