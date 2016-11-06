<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Wallpaper;

class PagesController extends Controller {

    public function __construct() {
        $this->middleware('guest')->only('index');
    }

    public function index() {
        $wallpaper = Wallpaper::inRandomOrder()->first();
        $quote = Quote::inRandomOrder()->first();

        return view('pages.index', compact('wallpaper', 'quote'));
    }
}
