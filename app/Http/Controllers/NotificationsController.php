<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        /*
         * Retrieve all the authorised users notifications and pass these to the notification view.
         * Also mark all unread notifications as read once they have been retrieved and passed to the
         * view.
         */
        $notifications = Auth::user()->notifications->unread();
        Auth::user()->unreadNotifications->markAsRead();
        return view('notifications.index', compact('notifications'));
    }
}
