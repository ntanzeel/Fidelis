<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SafetyController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('settings.safety.index', ['settings' => \Auth::user()->settings]);
    }

    public function store(Request $request) {
        $settings = $request->user()->settings;

        /**
         * @var $setting Setting
         */
        foreach ($settings as $setting) {
            if ($request->has($setting->name)) {
                $setting->value = $request->get($setting->name);
            }

            $setting->save();
        }

        return view('settings.safety.index', compact('settings'));
    }
}
