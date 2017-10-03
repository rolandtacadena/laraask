<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'commenter_id' => $faker->numberBetween(1, 10),
        'commentable_id' => $faker->numberBetween(1, 100),
        'commentable_type' => rand(0, 1) == 1 ? 'App\Question' : 'App\Answer',
        'body' => $faker->sentence(2)
    ];
});
