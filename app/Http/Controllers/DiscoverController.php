<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class DiscoverController extends Controller {

    private $categories;
    private $subscriptions;

    public function __construct() {
        if (Auth::check()) {
            $id = Auth::user()->id;
        }
        else {
            $id = 1;
        }
        $this->categories = Category::orderBy('name')->get();
        $this->subscriptions = Subscription::where('user_id', $id)->orderBy('id','desc')->get();
    }

    public function index() {
        return view('discover.index')->with('categories', $this->categories);
    }

    public function category($category) {
        return view('discover.category')->with('categories', $this->categories)->with('category', $category);
    }

    public function subscriptions() {
        return view('discover.subscriptions')->with('categories', $this->categories)->with('subscriptions', $this->subscriptions);
    }


}