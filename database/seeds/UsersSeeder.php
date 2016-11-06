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
            'name' => 'Naqash Tanzeel',
            'email' => 'n.tanzeel@hotmail.co.uk',
            'password' => bcrypt('123456'),
            'dob' => \Carbon\Carbon::create(1994, 11, 9),
            'reputation' => 0,
            'photo' => 'https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-10-3-128.png',
            'cover' => 'http://www.sawyoo.com/postpic/2009/06/blank-youtube-channel-art-template_699121.jpg',
            'is_private' => False,
        ]);

        App\Models\User::create([
            'name' => 'Ishe Gambe',
            'email' => 'ishegambe@yahoo.co.uk',
            'password' => bcrypt('rubberducky'),
            'dob' => \Carbon\Carbon::create(1995, 2, 14),
            'reputation' => 0,
            'photo' => 'https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-10-3-128.png',
            'cover' => 'http://www.sawyoo.com/postpic/2009/06/blank-youtube-channel-art-template_699121.jpg',
            'is_private' => False,
        ]);

        App\Models\User::create([
            'name' => 'Thomas McAloone',
            'email' => 'tmac@gmail.com',
            'password' => bcrypt('password1'),
            'dob' => \Carbon\Carbon::create(1995, 12, 21),
            'reputation' => 0,
            'photo' => 'https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-10-3-128.png',
            'cover' => 'http://www.sawyoo.com/postpic/2009/06/blank-youtube-channel-art-template_699121.jpg',
            'is_private' => False,
        ]);

        App\Models\User::create([
            'name' => 'Jordan Olney',
            'email' => 'jordanolney@gmail.com',
            'password' => bcrypt('password2'),
            'dob' => \Carbon\Carbon::create(1995, 3, 4),
            'reputation' => 0,
            'photo' => 'https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-10-3-128.png',
            'cover' => 'http://www.sawyoo.com/postpic/2009/06/blank-youtube-channel-art-template_699121.jpg',
            'is_private' => False,
        ]);
    }
}
