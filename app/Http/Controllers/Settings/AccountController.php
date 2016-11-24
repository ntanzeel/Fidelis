<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('settings.account.index');
    }

    public function edit_profile(Request $request) {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_private = $request->private == "private" ? 1 : 0;

        $user->save();

        return redirect()->route('settings.account.index');
    }

    public function upload_profile_pic(Request $request)
    {
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $path = $file->store('uploads/' . Auth::user()->uploadDirectory(), 'public');
            Auth::user()->photo = $path;
            Auth::user()->save();
        }

        return redirect()->back();
    }

    public function upload_cover_pic(Request $request) {
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $path = $file->store('uploads/' . Auth::user()->uploadDirectory(), 'public');
            Auth::user()->cover = $path;
            Auth::user()->save();
        }

        return redirect()->back();
    }

}
