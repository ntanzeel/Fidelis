<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        View::composer(config('view.layout') . '.app', 'App\Http\Composers\LayoutComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
