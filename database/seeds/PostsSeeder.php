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
            'tags'    => [],
        ],
        [
            'user_id' => 1,
            'tags'    => [],
        ],
        [
            'user_id' => 1,
            'tags'    => [],
        ],
        [
            'user_id' => 1,
            'tags'    => [],
        ],
        [
            'user_id' => 1,
            'tags'    => [],
        ],

        /*
         * Ishe - Politics/Sports
         */
        [
            'user_id' => 2,
            'tags'    => [],
        ],
        [
            'user_id' => 2,
            'tags'    => [],
        ],
        [
            'user_id' => 2,
            'tags'    => [],
        ],
        [
            'user_id' => 2,
            'tags'    => [],
        ],
        [
            'user_id' => 2,
            'tags'    => [],
        ],
        [
            'user_id' => 2,
            'tags'    => [],
        ],

        /*
         * Big Mac - Fashion
         */
        [
            'user_id' => 3,
            'tags'    => [],
        ],
        [
            'user_id' => 3,
            'tags'    => [],
        ],
        [
            'user_id' => 3,
            'tags'    => [],
        ],
        [
            'user_id' => 3,
            'tags'    => [],
        ],
        [
            'user_id' => 3,
            'tags'    => [],
        ],
        [
            'user_id' => 3,
            'tags'    => [],
        ],

        /*
         * Jordan - Politics/Fashion
         */
        [
            'user_id' => 4,
            'tags'    => [],
        ],
        [
            'user_id' => 4,
            'tags'    => [],
        ],
        [
            'user_id' => 4,
            'tags'    => [],
        ],
        [
            'user_id' => 4,
            'tags'    => [],
        ],
        [
            'user_id' => 4,
            'tags'    => [],
        ],
        [
            'user_id' => 4,
            'tags'    => [],
        ],
        [
            'user_id' => 4,
            'tags'    => [],
        ],

        /*
         * Hez - Politics
         */
        [
            'user_id' => 5,
            'tags'    => [],
        ],
        [
            'user_id' => 5,
            'tags'    => [],
        ],
        [
            'user_id' => 5,
            'tags'    => [],
        ],

        /*
         * Aria - Fashion
         */
        [
            'user_id' => 6,
            'tags'    => [],
        ],

        /*
         * Richard - Sports/Fashion
         */
        [
            'user_id' => 7,
            'tags'    => [],
        ],
        [
            'user_id' => 7,
            'tags'    => [],
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
