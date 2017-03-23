<?php

    namespace App\Http\Controllers\Api;

    use App\Models\Image;
    use App\Models\Post;
    use App\Models\User;

    class ImageController {

        public function post(Post $post, Image $image) {
            $next = $post->images()->where('id', '>', $image->id)->orderBy('id', 'ASC')->first(['id']);
            $previous = $post->images()->where('id', '<', $image->id)->orderBy('id', 'DESC')->first(['id']);

            return response()->json([
                'source'   => asset('storage/' . $image->path),
                'next'     => $next ? $next->id : FALSE,
                'previous' => $previous ? $previous->id : FALSE,
            ]);
        }

        public function user(User $user, Image $image) {
            $next = $user->images()->where('images.id', '<', $image->id)->orderBy('images.id', 'DESC')->first(['images.id']);
            $previous = $user->images()->where('images.id', '>', $image->id)->orderBy('images.id', 'ASC')->first(['images.id']);

            return response()->json([
                'source'   => asset('storage/' . $image->path),
                'next'     => $next ? $next->id : FALSE,
                'previous' => $previous ? $previous->id : FALSE,
            ]);
        }
    }