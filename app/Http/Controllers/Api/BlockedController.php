<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlockRequest;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockedController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function store(BlockRequest $request) {
        /**
         * @var $user User
         */
        $user = User::findOrFail($request->get('id'));

        Follower::where(function ($query) use ($user) {
            $query->where('follower_id', $user->id);
            $query->where('following_id', Auth::user()->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('follower_id', $user->id);
            $query->where('following_id', Auth::user()->id);
        })->delete();

        $request->user()->blocked()->attach($user);

        return response()->json(['success' => true]);
    }

    public function delete($user, Request $request) {
        $request->user()->blocked()->detach($user);

        return response()->json(['success' => true]);
    }
}
