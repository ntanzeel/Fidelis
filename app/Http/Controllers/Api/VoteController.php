<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoteRequest;
use App\Models\Comment;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }


    /**
     * @param Comment $comment
     * @param VoteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Comment $comment, VoteRequest $request) {
        $vote = $comment->votes()->firstOrNew(['user_id' => Auth::user()->id]);
        $vote->type = $request->get('type');

        if ($vote->isDirty('type')) {
            if ($vote->exists) {
                $comment->{($vote->type == 'up' ? 'down' : 'up') . '_votes'} -= 1;
            }
            $comment->{$vote->type . '_votes'} += 1;
        }

        $vote->save();
        $comment->save();

        return response()->json(['success' => 'true']);
    }

    public function delete(Vote $vote) {
        if ($vote->user_id != Auth::user()->id) {
            abort(403);
        }

        $vote->delete();
    }
}
