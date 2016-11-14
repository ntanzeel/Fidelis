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
        if (Auth::check()) {
            $tag = (Tag::where('text', $category)->first())->id;
            $subscribed = (Subscription::where('user_id', Auth::user()->id)->where('tag_id', $tag)->first() !== null);
        } else {
            $tag = [];
            $subscribed = [];
        }
        return view('discover.category')->with('categories', $this->categories)->with('category', $category)->with('subscribed', $subscribed)->with('tag', $tag);
    }

    public function subscriptions() {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $subscriptions = Subscription::where('user_id', $id)->orderBy('id', 'desc')->get();
            return view('discover.subscriptions')->with('categories', $this->categories)->with('subscriptions', $subscriptions);
        } else {
            return view('auth.login.index');
        }
    }


}