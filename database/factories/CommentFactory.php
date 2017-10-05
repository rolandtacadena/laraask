<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'commenter_id' => $faker->randomElement(\App\User::pluck('id')->toArray()),
        'commentable_id' => $faker->randomElement(\App\Answer::pluck('id')->toArray()),
        'commentable_type' => 'App\Answer',
        'body' => $faker->sentence(2)
    ];
});
