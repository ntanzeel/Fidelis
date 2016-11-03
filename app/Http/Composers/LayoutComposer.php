<?php

namespace App\Http\Composers;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class LayoutComposer {

    private $categories;

    public function __construct() {
        $this->categories = Category::orderBy('name');
    }

    public function compose(View $view) {
        $view->with('categories', $this->categories->get());
    }
}