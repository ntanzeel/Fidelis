<?php

namespace App\Widgets;

use App\Models\Tag;
use Arrilot\Widgets\AbstractWidget;
use App\Models\Post;
use Carbon\Carbon;

class Trending extends AbstractWidget {

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run() {

        $trends = Tag::distinct('text')->withCount(['posts' => function ($query) {
            $query->where('post_tag.created_at', '>=', Carbon::now()->subDay());
        }])->orderBy('posts_count', 'desc')->limit(10)->get();


        return view("widgets.trending", [
            'config' => $this->config,
            'trends' => $trends,
        ]);
    }
}