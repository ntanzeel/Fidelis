<?php

namespace App\Http\Traits;

use App\Http\Requests\CommentRequest;
use App\Models;
use App\Notifications\Comment;
use App\Notifications\Mention;
use Illuminate\Support\Facades\Auth;

trait Post {

    public function add(CommentRequest $request) {
        $post = Auth::user()->posts()->save(new Models\Post());

        $comment = $this->addComment($post, $request, true);

        if ($request->hasFile('images')) {
            $this->uploadImages($post, $request);
        }

        $this->categorise($post, $this->getTags($comment));

        return $post;
    }

    protected function addComment(Models\Post $post, CommentRequest $request, $root = false) {
        $comment = new Models\Comment([
            'user_id'     => Auth::user()->id,
            'text'        => e($request->get('text')),
            'up_votes'    => 0,
            'down_votes'  => 0,
            'root'        => $root,
            'abuse_score' => 0,
        ]);

        $post->comments()->save($comment);

        $post->no_comments += 1;

        $post->save();

        $this->notifyUsers($comment, $this->getMentions($comment), $post);

        return $comment;
    }

    protected function notifyUsers(Models\Comment $comment, $mentions, Models\Post $post) {
        if (!$comment->root && $comment->user_id != $post->user_id) {
            $post->user->notify(new Comment($comment));
        }

        if (!empty($mentions)) {
            $mentioned = Models\User::whereIn('username', $mentions)->get();

            foreach ($mentioned as $user) {
                $user->notify(new Mention($comment));
            }
        }
    }

    protected function getMentions(Models\Comment $comment) {
        preg_match_all('/@(\w+)/', $comment->text, $users);
        return empty($users) ? [] : $users[1];
    }

    protected function uploadImages(Models\Post $post, CommentRequest $request) {
        foreach ($request->file('images') as $file) {
            $path = $file->store('uploads/' . Auth::user()->uploadDirectory(), 'public');
            $post->images()->save(new Models\Image(['user_id' => Auth::user()->id, 'path' => $path]));
        }
    }

    protected function getNonTags(Models\Comment $comment) {
        preg_match_all('/(\w*[a-zA-Z]\w*){4,}/', $comment->text, $words); //Ensure it is valid tag and is a minimum of 3 characters
        return empty($words) ? [] : $words[1];
    }

    protected function categorise(Models\Post $post, $tags) {
        foreach ($tags as $tag) {
            $post->tags()->attach(Models\Tag::firstOrCreate(['text' => $tag]));
        }
        if (empty($tags)) {
            $words = $this->getNonTags($post->content);
            $existing_tags = Models\Tag::wherein('text',$words)->get();
            $post->tags()->attach($existing_tags);
        }
    }

    protected function getTags(Models\Comment $comment) {
        preg_match_all('/\B#(\w*[a-zA-Z]+\w*)/', $comment->text, $tags);
        return empty($tags) ? [] : $tags[1];
    }

    public function comment(Models\Post $post, CommentRequest $request) {
        return $post && $post->exists ? $this->addComment($post, $request) : false;
    }


}
