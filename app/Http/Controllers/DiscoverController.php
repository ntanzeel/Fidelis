<?php

namespace App\Http\Controllers;

class DiscoverController extends Controller {

    public function index() {
        return 'Discover Home';
    }

    public function category($category) {
        return 'Discover ' . $category;
    }
}