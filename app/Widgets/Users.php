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
        $users = array();
        $recommendations = Auth::user()->user_recommendations()->get();

        foreach($recommendations as $recommendation) {
            array_push($users, User::find($recommendation->user_recommendation));
        }

        return view("widgets.users", [
            'config' => $this->config,
            'recommendations' => $users,
        ]);
    }
}