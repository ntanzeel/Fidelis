<?php

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder {

    protected $data = [
        [
            'name'        => 'Arts',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Arts',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Business',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Business',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Education',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Education',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Games',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Games',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Health',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Health',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Home',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Home',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'News',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'News',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Recreation',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Recreation',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Science',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Science',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Shopping',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Shopping',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Society',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Society',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Sport',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Sport',
                    'root' => true,
                ],
            ],
        ], [
            'name'        => 'Technology',
            'description' => '',
            'tags'        => [
                [
                    'text' => 'Technology',
                    'root' => true,
                ],
            ],
        ]];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        foreach ($this->data as $cat) {
            $category = Category::create([
                'name'        => $cat['name'],
                'description' => $cat['description'],
            ]);

            foreach ($cat['tags'] as $t) {
                $tag = Tag::create([
                    'text' => $t['text'],
                ]);

                $category->tags()->attach($tag->id, ['root' => $t['root']]);
            }
        }
    }
}
