<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        View::composer(config('view.layout') . '.app', 'App\Http\Composers\LayoutComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {

    }
}
