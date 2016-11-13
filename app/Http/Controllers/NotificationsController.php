<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller {

    public function index() {
        $notifications = Auth::user()->notifications()->with(['from', 'to', 'comment'])->get();

        return view('notifications.index', compact('notifications'));
    }
}
