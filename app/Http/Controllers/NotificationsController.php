<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller {

    public function index() {
        $notifications = Auth::user()->notifications;
        Auth::user()->unreadNotifications->markAsRead();
        return view('notifications.index', compact('notifications'));
    }
}
