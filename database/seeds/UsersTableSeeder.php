<?php

use App\User;
use App\Tag;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create()->each(function($user) {
            $tagIds = Tag::pluck('id')->toArray();
            $randomKey = array_rand($tagIds);
            $user->favoriteTags()->attach($tagIds[$randomKey]);

        });

        $user = User::first();
        $user->name = 'Roland Tacadena';
        $user->email = 'tacadena.roland@gmail.com';
        $user->password = bcrypt('090412');
        $user->save();
    }
}
