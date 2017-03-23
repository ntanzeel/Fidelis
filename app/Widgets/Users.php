<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Users extends AbstractWidget {

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run() {
        $recommendations = Auth::user()->user_recommendations()
            ->where('response', 0)->get();

        return view("widgets.users", [
            'config' => $this->config,
            'recommendations' => $recommendations,
        ]);
    }
}