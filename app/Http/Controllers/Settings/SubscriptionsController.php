<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller {

    public function _construct() {
        $this->middleware('auth');
    }

    public function index() {
        $categories = Category::orderBy('name')->get();
        $subscriptions = Auth::user()->subscriptions();
        return view('settings.subscriptions.index', [
            'categories'    => $categories,
            'subscriptions' => $subscriptions
        ]);
    }

    public function subscribe(Request $request) {
        $tag = Tag::find($request->tag);
        Auth::user()->subscriptions()->attach($tag);
        return "Added " . $tag;
    }

    public function unsubscribe(Request $request) {
        $tag = Tag::find($request->tag);
        Auth::user()->subscriptions()->detach($tag);

        return "Deleted " . $tag;
    }
}
