<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Models\User::create([
            'name'       => 'Naqash Tanzeel',
            'email'      => 'n.tanzeel@hotmail.co.uk',
            'password'   => bcrypt('123456'),
            'dob'        => \Carbon\Carbon::create(1994, 11, 9),
            'reputation' => 0,
            'photo'      => 'https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-10-3-128.png',
            'cover'      => 'http://www.sawyoo.com/postpic/2009/06/blank-youtube-channel-art-template_699121.jpg',
            'is_private' => False,
        ]);

        App\Models\User::create([
            'name'       => 'Ishe Gambe',
            'email'      => 'ishegambe@yahoo.co.uk',
            'password'   => bcrypt('rubberducky'),
            'dob'        => \Carbon\Carbon::create(1995, 2, 14),
            'reputation' => 0,
            'photo'      => 'https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-10-3-128.png',
            'cover'      => 'http://www.sawyoo.com/postpic/2009/06/blank-youtube-channel-art-template_699121.jpg',
            'is_private' => False,
        ]);

        App\Models\User::create([
            'name'       => 'Thomas McAloone',
            'email'      => 'tmac@gmail.com',
            'password'   => bcrypt('password1'),
            'dob'        => \Carbon\Carbon::create(1995, 12, 21),
            'reputation' => 0,
            'photo'      => 'https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-10-3-128.png',
            'cover'      => 'http://www.sawyoo.com/postpic/2009/06/blank-youtube-channel-art-template_699121.jpg',
            'is_private' => False,
        ]);

        App\Models\User::create([
            'name'       => 'Jordan Olney',
            'email'      => 'jordan.olney@gmail.com',
            'password'   => bcrypt('hello'),
            'dob'        => \Carbon\Carbon::create(1995, 2, 8),
            'reputation' => 0,
            'photo'      => 'https://scontent-lhr3-1.xx.fbcdn.net/v/t1.0-9/14570212_10154044736877831_8383816738414998787_n.jpg?oh=ad9717314da1adb34a3626eaff1dc37c&oe=58CF5C7A',
            'cover'      => 'http://www.sawyoo.com/postpic/2009/06/blank-youtube-channel-art-template_699121.jpg',
            'is_private' => False,
        ]);
    }
}
