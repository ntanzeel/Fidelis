<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /*
         * Naqash
         */
        App\Models\Comment::create([
            'user_id'    => 1,
            'post_id'    => 1,
            'text'    => 'If Trump is elected as president we will see positive changes in American politics',
            'reputation' => 10,
            'root'       => true,
        ]);

        // comments on each post to be added...

        App\Models\Comment::create([
            'user_id'    => 1,
            'post_id'    => 2,
            'text'    => 'Brexit needs to happen already',
            'reputation' => 0,
            'root'       => true,
        ]);

        App\Models\Comment::create([
            'user_id'    => 1,
            'post_id'    => 3,
            'text'    => 'Theresa May is in bed with Trump but she\'s his sidechick and doesn\'t know lol',
            'reputation' => 0,
            'root'       => true,
        ]);

        App\Models\Comment::create([
            'user_id'    => 1,
            'post_id'    => 4,
            'text'    => 'We should go back to sending all the useless people to Australia like in the good old days',
            'reputation' => 0,
            'root'       => true,
        ]);

        App\Models\Comment::create([
            'user_id'    => 1,
            'post_id'    => 5,
            'text'    => 'Trump is taking America waaaaaay downhill',
            'reputation' => 0,
            'root'       => true,
        ]);

        /*
         * Ishe
         */
        App\Models\Comment::create([
            'user_id'    => 2,
            'post_id'    => 6,
            'text'    => 'Georgia Armani\'s summer collection will be to die for, but where is the money going to come...',
            'reputation' => 200,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 2,
            'post_id'    => 7,
            'text'    => 'Mourinho is taking us back to our glory days',
            'reputation' => 5,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 2,
            'post_id'    => 8,
            'text'    => 'Justin Trideau is a real G',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 2,
            'post_id'    => 9,
            'text'    => 'These right-wing extremists groups are popping up EVERYWHERE',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 2,
            'post_id'    => 10,
            'text'    => 'Martial really needs to step his game up. He\'s had some disappointing games lately',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 2,
            'post_id'    => 11,
            'text'    => 'I can feel it, united are gonna sneak the quadruple this season',
            'reputation' => 0,
            'root'       => true,
        ]);

        /*
         * Big Mac
         */
        App\Models\Comment::create([
            'user_id'    => 3,
            'post_id'    => 12,
            'text'    => 'Looking to cop a pair of Jordan XIIs size 13',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 3,
            'post_id'    => 13,
            'text'    => 'Selling a pair of all-white AF1s hmu',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 3,
            'post_id'    => 14,
            'text'    => 'Trump tryna stop me from getting this money man',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 3,
            'post_id'    => 15,
            'text'    => 'Man you can\'t go wrong with Jordan brand!',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 3,
            'post_id'    => 16,
            'text'    => 'Bet LeBron would KILL IT as a soccer player',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 3,
            'post_id'    => 17,
            'text'    => 'Bout to get me a pair of the latest KDs LETS GO',
            'reputation' => 0,
            'root'       => true,
        ]);

        /*
         *
         */
        App\Models\Comment::create([
            'user_id'    => 4,
            'post_id'    => 18,
            'text'    => 'Excited for my trip to the House of Commons',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 4,
            'post_id'    => 19,
            'text'    => 'European politics are a joke!',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 4,
            'post_id'    => 20,
            'text'    => 'I still can\'t believe how Sam Allardyce managed to secure a job in the EPL...',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 4,
            'post_id'    => 21,
            'text'    => 'Clothes',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 4,
            'post_id'    => 22,
            'text'    => 'Theresa May is a witch for appointing Boris as a cabinet minister',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 4,
            'post_id'    => 23,
            'text'    => 'More clothes',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 4,
            'post_id'    => 24,
            'text'    => 'Nigel Farage is an absolute cunt',
            'reputation' => 0,
            'root'       => true,
        ]);

        App\Models\Comment::create([
            'user_id'    => 5,
            'post_id'    => 25,
            'text'    => 'Nigel Farage and Boris Johnson conned the whole of Europe with their scheming',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 5,
            'post_id'    => 26,
            'text'    => 'I think we all need to be a bit more optimistic when it comes to Brexit',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 5,
            'post_id'    => 27,
            'text'    => 'Bring back the death penalty',
            'reputation' => 0,
            'root'       => true,
        ]);

        App\Models\Comment::create([
            'user_id'    => 6,
            'post_id'    => 28,
            'text'    => 'Louis Vitton is my HERO <3',
            'reputation' => 0,
            'root'       => true,
        ]);

        App\Models\Comment::create([
            'user_id'    => 7,
            'post_id'    => 29,
            'text'    => 'Dele Alli is doing bits at Tottenham. Watch him get snapped up by Madrid real soon',
            'reputation' => 0,
            'root'       => true,
        ]);
        App\Models\Comment::create([
            'user_id'    => 7,
            'post_id'    => 30,
            'text'    => 'Opening a few buttons on your shirt is the FRESHEST ting anyone can do',
            'reputation' => 0,
            'root'       => true,
        ]);
    }
}
