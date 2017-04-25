<?php

    namespace App\Providers;

    use App\Models\Comment;
    use App\Models\Post;
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
                 * @var User $user
                 */
                $user->posts()->delete();
                $user->comments()->delete();
                $user->settings()->delete();
                $user->followers()->detach();
                $user->following()->detach();
                $user->blocked()->detach();
                $user->subscriptions()->detach();
                $user->votes()->detach();
                $user->reported()->detach();
                $user->notifications()->delete();
            });

            Post::deleting(function ($post) {
                /**
                 * @var Post $post
                 */
                $post->content()->delete();
                $post->comments()->delete();
                $post->images()->delete();
                $post->tags()->detach();
            });

            Comment::deleting(function ($comment) {
                /**
                 * @var Comment $comment
                 */
                $comment->votes()->delete();
                $comment->reports()->delete();
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
