<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subscription;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class DiscoverController extends Controller {

    private $categories;

    public function __construct() {
        $this->categories = Category::orderBy('name')->get();
    }

    public function index() {
        return view('discover.index')->with('categories', $this->categories);
    }

    public function category($category) {
        $tag = (Tag::where('text', $category)->first())->id;
        $subscribed = (Auth::user()->subscriptions()->where('tag_id', $tag)->first() !== null) ? true : false;

        return view('discover.category')->with('categories', $this->categories)->with('category', $category)->with('subscribed', $subscribed)->with('tag', $tag);
    }

    public function subscriptions() {
        $subscriptions = Auth::user()->subscriptions();
        return view('discover.subscriptions')->with('categories', $this->categories)->with('subscriptions', $subscriptions);
    }


}