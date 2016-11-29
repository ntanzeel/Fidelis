<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FollowRequest;
use App\Notifications\Follow;


class FollowersController extends Controller {

    public function store(FollowRequest $request){
        $user = User::findOrFail($request->get('user'));
        $approved = !$user->is_private;
        $mutual = $user->follows(Auth::user());
        if ($approved && $mutual) {
            $user->following()
                ->newPivotStatement()
                ->where('following_id', Auth::user()->id)->update(['mutual'=>1]);
        }
        Auth::user()->following()->attach($user, ['approved'=>$approved, 'mutual'=>$mutual]);

        $user->notify(new Follow(Auth::user()));
        return response()->json(['success' => true]);
    }

    public function delete($user){
        $user = User::findOrFail($user);
        Auth::user()->following()->detach($user);
        return response()->json(['success' => true]);
    }

}