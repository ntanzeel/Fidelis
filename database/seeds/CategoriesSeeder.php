<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;

class CategoriesSeeder extends Seeder {

    protected $data = [
        [
            'name'          => 'Travel',
            'description'   => 'Latest travel news from around the world.',
            'tags'          => [
                [
                    'text'  => 'Travel',
                    'root'  => true
                ]
            ]
        ], [
            'name'          => 'Politics',
            'description'   => 'They say you should not talk about religion or politics in mixed company, and yet, that\'s exactly what people want to talk about.',
            'tags'          => [
                [
                    'text'  => 'Politics',
                    'root'  => true
                ], [
                    'text'  => 'Brexit',
                    'root'  => false
                ], [
                    'text'  => 'Article50',
                    'root'  => false
                ], [
                    'text'  => 'Parliament',
                    'root'  => false
                ], [
                    'text'  => 'ElectionDay',
                    'root'  => false
                ], [
                    'text'  => 'Election2016',
                    'root'  => false
                ],
            ]
        ], [
            'name'          => 'Home',
            'description'   => 'Stay up to date with home and garden trends.',
            'tags'          => [
                [
                    'text'  => 'Home',
                    'root'  => true
                ]
            ]
        ], [
            'name'          => 'Sports',
            'description'   => 'Stay up to date with the latest sports.',
            'tags'          => [
                [
                    'text'  => 'Sports',
                    'root'  => true
                ]
            ]
        ], [
            'name'          => 'Food',
            'description'   => 'When it comes to food and wine, the first rule to remember is that there are no rules.',
            'tags'          => [
                [
                    'text'  => 'Food',
                    'root'  => true
                ]
            ]
        ], [
            'name'          => 'Health',
            'description'   => 'Discuss all kinds of health related issues.',
            'tags'          => [
                [
                    'text'  => 'Health',
                    'root'  => true
                ]
            ]
        ], [
            'name'          => 'Finance',
            'description'   => 'This is a degree for those interested in learning how the banking and finance systems work.',
            'tags'          => [
                [
                    'text'  => 'Finance',
                    'root'  => true
                ]
            ]
        ], [
            'name'          => 'Fashion',
            'description'   => 'Jewelry and clothing fashions vary with the season.',
            'tags'          => [
                [
                    'text'  => 'Fashion',
                    'root'  => true
                ]
            ]
        ], [
            'name'          => 'Fine Arts',
            'description'   => 'From 2011, all students will complete a three-year degree, either in fine arts or music.',
            'tags'          => [
                [
                    'text'  => 'Fine Arts',
                    'root'  => true
                ]
            ]
        ], [
            'name'          => 'Education',
            'description'   => 'Education news on the VCE, universities, TAFE and other higher education options in the world.',
            'tags'          => [
                [
                    'text'  => 'Education',
                    'root'  => true
                ]
            ]
        ], [
            'name'          => 'Miscellaneous',
            'description'   => 'Regimes, rulers and miscellaneous radicals have come and gone.',
            'tags'          => [
                [
                    'text'  => 'Miscellaneous',
                    'root'  => true
                ]
            ]
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        foreach ($this->data as $cat) {
            $category = Category::create([
                'name'          => $cat['name'],
                'description'   =>$cat['description']
            ]);

            foreach ($cat['tags'] as $t) {
                $tag = Tag::create([
                    'text'  => $t['text']
                ]);

                $category->tags()->attach($tag->id, ['root' => $t['root']]);
            }
        }
    }
}
