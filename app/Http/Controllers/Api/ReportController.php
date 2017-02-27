<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller {

    public function store(Comment $comment, Request $request) {
        if ($comment->user_id == $request->user()->id) {
            abort(403);
        }

        $report = Report::firstOrCreate([
            'user_id'    => $request->user()->id,
            'comment_id' => $comment->id,
            'processed'  => 0,
        ]);

        if (!$report->wasRecentlyCreated) {
            return $this->delete($report, $request);
        }

        return response()->json(['status' => $report->exists]);
    }

    public function delete(Report $report, Request $request) {
        if ($report->user_id != $request->user()->id) {
            abort(403);
        }

        $report->delete();

        return response()->json(['status' => $report->exists]);
    }
}
