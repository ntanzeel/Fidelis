<?php

    namespace App\Providers;

    use App\Models\User;
    use Illuminate\Support\ServiceProvider;

    class SoftCascadeProvider extends ServiceProvider {

        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot() {
            User::deleting(function ($user) {
                /**
                 * @var $user User
                 */
                $user->posts()->delete();
                $user->settings()->detach();
                $user->followers()->detach();
                $user->following()->detach();
                $user->subscriptions()->detach();
            });
        }

        /**
         * Register the application services.
         *
         * @return void
         */
        public function register() {
            //
        }
    }
