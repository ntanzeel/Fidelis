<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FollowRequest;


class FollowersController {

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
        return response()->json(['success' => true]);
    }

    public function delete(User $user){
        Auth::user()->following()->detach($user);
        return response()->json(['success' => true]);
    }

}