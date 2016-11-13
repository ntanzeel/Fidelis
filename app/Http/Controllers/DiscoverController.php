<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class DiscoverController extends Controller {

    private $categories;
    private $subscriptions;

    public function __construct() {
        $this->categories = Category::orderBy('name')->get();
        $this->subscriptions = ['#brexit'];
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