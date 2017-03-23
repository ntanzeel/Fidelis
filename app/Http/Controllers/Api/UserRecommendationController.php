<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FollowRequest;
use App\Models\UserRecommendation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserRecommendationController extends FollowersController {

    public function store(FollowRequest $request) {
        parent::store($request);

        Auth::user()->user_recommendations()
            ->newPivotStatement()
            ->where('user_id', Auth::user()->id)
            ->where('user_recommendation', $request->get('user'))
            ->update(['response' => 1]);

        return response()->json(['success' => true]);
    }

    public function delete($user) {
        Auth::user()->user_recommendations()
            ->newPivotStatement()
            ->where('user_id', Auth::user()->id)
            ->where('user_recommendation', $user)
            ->update(['response' => -1]);

        return response()->json(['success' => true]);
    }
}
