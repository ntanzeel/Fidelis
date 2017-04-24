<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Notifications\Follow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PendingRequest;

class PendingController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @param PendingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PendingRequest $request) {
        Auth::user()->pendingFollowers()
            ->newPivotStatement()
            ->where('following_id', Auth::user()->id)
            ->where('follower_id', $request->get('user'))
            ->update(['approved' => 1]);

        return response()->json(['success' => true]);
    }

    public function delete($user) {
        Auth::user()->pendingFollowers()->where('user_id', $user)->detach();

        return response()->json(['success' => true]);
    }
}
