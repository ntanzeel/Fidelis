<?php

namespace App\Http\Controllers\Api;
use App\Models\Tag;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Support\Facades\Auth;


class SubscriptionsController {

    public function store(SubscriptionRequest $request) {
        $tag = Tag::findOrFail($request->get('tag'));
        Auth::user()->subscriptions()->attach($tag);
        return response()->json(['success' => true]);
    }

    public function delete(Tag $subscription) {
        Auth::user()->subscriptions()->detach($subscription);
        return response()->json(['success' => true]);
    }

}

