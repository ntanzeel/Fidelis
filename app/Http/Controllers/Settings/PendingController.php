<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendingController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('settings.pending.index', ['users' => \Auth::user()->pendingFollowers()->get()]);
    }
}
