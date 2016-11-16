<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class DiscoverController extends Controller {

    private $categories;

    public function __construct() {
        $this->categories = Category::orderBy('name')->get();
    }

    public function index() {
        $subscriptions = Auth::user()->subscriptions();
        return view('discover.subscriptions')->with('categories', $this->categories)->with('subscriptions', $subscriptions);
    }

    public function category($category) {
        $tag = Tag::where('text', $category)->first()->id;

        if (!$tag) {
            return redirect()->route('discover.index');
        }

        $subscribed = (Auth::user()->subscriptions()->where('tag_id', $tag)->first() !== null) ? true : false;

        return view('discover.category', [
            'categories' => $this->categories,
            'category' => $category,
            'subscribed' => $subscribed,
            'tag' => $tag
        ]);
    }
}
