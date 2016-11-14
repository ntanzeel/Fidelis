<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller {

    public function subscribe(Request $request) {
        $tag = $request->tag;
        Subscription::create([
            'user_id' => Auth::user()->id ? Auth::user()->id : 4,
            'tag_id'  => $tag,
        ]);
        return "Added " . $tag;
    }

    public function unsubscribe(Request $request) {
        $tag = $request->tag;

        Subscription::where([
            'user_id' => Auth::user()->id ? Auth::user()->id : 4,
            'tag_id'  => $tag,
        ])->delete();
        return "Deleted " . $tag;
    }
}
