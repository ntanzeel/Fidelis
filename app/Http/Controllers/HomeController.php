<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $userIds = Auth::user()->following()->pluck('users.id');
        $userIds[] = Auth::user()->id;
        $with = ['content', 'images'];
        $with['content.votes'] = $with['content.reports'] = function($query) {
            $query->where('user_id', Auth::user()->id);
        };
        $posts = Post::whereIn('user_id', $userIds)->with($with)->latest()->get();
        return view('home.index', compact('posts'));
    }
}
