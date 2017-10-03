<?php

use Faker\Generator as Faker;

$factory->define(\App\Vote::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'votable_id' => $faker->numberBetween(1, 100),
        'votable_type' => rand(0, 1) == 1 ? 'App\Question' : 'App\Answer',
        'count' => 0,
    ];
});
