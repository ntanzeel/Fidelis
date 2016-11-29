<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoteRequest;
use App\Models\Comment;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Notifications;

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
        /**
         * @var $vote Vote
         */
        $vote = $comment->votes()->firstOrNew(['user_id' => $request->user()->id]);
        $vote->type = $request->get('type');

        /*
         * If the type fields is not dirty, it means a vote of this type already exists.
         * Hence, clicking the same action should reverse the vote.
         * e.g. If you've liked a post, clicking the like button should unlike it.
         */
        if (!$vote->isDirty('type')) {
            return $this->delete($comment, $vote, $request);
        }

        /*
         * By this stage, through logic, the vote type must be dirty (has changed).
         * If the vote already exists and it's dirty, it means the user has changed their vote.
         * In this scenario, the old vote type has to be decremented.
         * e.g. If the user likes a post they previously disliked, the no of down votes must be decremented.
         */
        if ($vote->exists) {
            $comment->{($vote->type == 'up' ? 'down' : 'up') . '_votes'} -= 1;
        }

        /*
         * Now the number of votes for the type cast by user can be incremented.
         * e.g. If the user likes a post, the number of up votes needs to be incremented.
         */
        $comment->{$vote->type . '_votes'} += 1;

        /*
         * Save the changes to the vote and comment model.
         */
        $vote->save();
        $comment->save();

        /*
         * Notify the comments' user that someone has voted on their comment
         */
        $comment->user->notify(new Notifications\Vote($vote));

        /*
         * Return the new number of likes and dislikes so it can be updated on the view.
         */
        return response()->json(['likes' => $comment->up_votes, 'dislikes' => $comment->down_votes]);
    }

    public function delete(Comment $comment, Vote $vote, Request $request) {
        if ($vote->user_id != $request->user()->id) {
            abort(403);
        }

        /*
         * Decrement the number of votes (for this type of vote).
         * e.g. If the vote being deleted was a down vote then the number of down votes must be decremented.
         */
        $comment->{$vote->type . '_votes'} -= 1;

        /*
         * Delete the vote from the votes table.
         */
        $vote->delete();

        /*
         * Save the changes to the comment model.
         */
        $comment->save();

        /*
         * Return the new number of likes and dislikes so it can be updated on the view.
         */
        return response()->json(['likes' => $comment->up_votes, 'dislikes' => $comment->down_votes]);
    }
}
