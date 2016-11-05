<?php

namespace App\Http\Controllers;

use App\Models\Category;

class DiscoverController extends Controller {

    private $categories;

    public function __construct() {
        $this->categories = Category::orderBy('name')->get();
    }

    public function index() {
        return view('discover.index')->with('categories', $this->categories);
    }

    public function category($category) {
        return view('discover.category')->with('categories', $this->categories)->with('category', $category);
    }
}