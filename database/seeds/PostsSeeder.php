<?php

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $data = [
        [
            'user_id' => 1,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 4,
            'tags'    => ['Sports', 'Politics'],
        ],
        [
            'user_id' => 2,
            'tags'    => ['Fashion'],
        ]
    ];

    public function run() {
        foreach ($this->data as $dat) {
            $post = Post::create([
                'user_id' => $dat['user_id'],
            ]);

            for ($i = 0; $i < sizeof($dat['tags']); $i++) {
                $tag = Tag::where('text', $dat['tags'][$i])->first();
                $post->tags()->attach($tag->id);
            }
        }
    }
}
