<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function display(Request $request) {
        $query = \Request::get('q');

        //Get all users with usernames 'like' input
        $posts = $query ? User::where([
            ['name', 'LIKE', "%$query%"],
        ])->select('id as user_id')->orderBy('id')->get() : User::select('id as user_id')->orderBy('id')->get();

        //Get all non-root tags 'like' inputs
        $tags = $query ? Tag::where([
            ['text', 'LIKE', "%$query%"],
            ['root', '!=', 1],
        ])->select('id as tag_id')->orderBy('id')->get() : Tag::select('id as tag_id')->orderBy('id')->get();

        //Merge query results
        $result = $posts->merge($tags);

        return response()->json([
            //not sure exactly what to return here?
        ]);
    }
}
