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
        /*
         * Naqash - Politics
         */
        [
            'user_id' => 1,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 1,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 1,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 1,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 1,
            'tags'    => ['Politics'],
        ],

        /*
         * Ishe - Politics/Sports
         */
        [
            'user_id' => 2,
            'tags'    => ['Fashion'],
        ],
        [
            'user_id' => 2,
            'tags'    => ['Sports'],
        ],
        [
            'user_id' => 2,
            'tags'    => ['Sports'],
        ],
        [
            'user_id' => 2,
            'tags'    => ['Sports'],
        ],
        [
            'user_id' => 2,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 2,
            'tags'    => ['Politics'],
        ],

        /*
         * Big Mac - Fashion
         */
        [
            'user_id' => 3,
            'tags'    => ['Fashion'],
        ],
        [
            'user_id' => 3,
            'tags'    => ['Fashion'],
        ],
        [
            'user_id' => 3,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 3,
            'tags'    => ['Fashion'],
        ],
        [
            'user_id' => 3,
            'tags'    => ['Sports'],
        ],
        [
            'user_id' => 3,
            'tags'    => ['Fashion'],
        ],

        /*
         * Jordan - Politics/Fashion
         */
        [
            'user_id' => 4,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 4,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 4,
            'tags'    => ['Sports'],
        ],
        [
            'user_id' => 4,
            'tags'    => ['Fashion'],
        ],
        [
            'user_id' => 4,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 4,
            'tags'    => ['Fashion'],
        ],
        [
            'user_id' => 4,
            'tags'    => ['Politics'],
        ],

        /*
         * Hez - Politics
         */
        [
            'user_id' => 5,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 5,
            'tags'    => ['Politics'],
        ],
        [
            'user_id' => 5,
            'tags'    => ['Politics'],
        ],

        /*
         * Aria - Fashion
         */
        [
            'user_id' => 6,
            'tags'    => ['Fashion'],
        ],

        /*
         * Richard - Sports/Fashion
         */
        [
            'user_id' => 7,
            'tags'    => ['Sports'],
        ],
        [
            'user_id' => 7,
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
