<?php

namespace App\Http\Controllers;

class DiscoverController extends Controller {

    public function index() {
        return view('home.index');
    }

    public function category($category) {
        return view('home.index');
    }
}