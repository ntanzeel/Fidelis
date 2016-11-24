<?php

namespace App\Http\Traits;

use App\Models;
use Illuminate\Support\Facades\Auth;

trait Subscription {

    public function subscribe(SubscriptionRequest $request) {
        $tag = Models\Tag::find($request->tag);
        Auth::user()->subscriptions()->attach($tag);
        $subscription = (Auth::user()->subscribes())->where('tag_id',$tag->id)->first();
        return $subscription;
    }

    public function unsubscribe(SubscriptionRequest $request) {
        $tag = Models\Tag::find($request->tag);
        $subscription = (Auth::user()->subscribes())->where('tag_id',$tag->id)->first();
        Auth::user()->subscriptions()->detach($tag);
        return $subscription;
    }

}