<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Subscription;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionsController extends Controller {

    public function _construct() {
        $this->middleware('auth');
    }

    public function index() {
        $categories = Category::orderBy('name')->get();
        $subscriptions = Auth::user()->subscriptions;
        return view('settings.subscriptions.index', [
            'categories'    => $categories,
            'subscriptions' => $subscriptions,
        ]);
    }

}
