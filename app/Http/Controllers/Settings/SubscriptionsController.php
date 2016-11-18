<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller {

    public function _construct() {
        $this->middleware('auth');
    }

    public function index() {

    }

    public function subscribe(Request $request) {
        $tag = Tag::find($request->tag);
        Auth::user()->subscriptions()->attach($tag);
        return "Added " . $tag;
    }

    public function unsubscribe(Request $request) {
        $tag = Tag::find($request->tag);
        Auth::user()->subscriptions()->detach($tag);

        return "Deleted ".$tag;
    }
}
