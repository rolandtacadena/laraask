<?php

use Faker\Generator as Faker;

$factory->define(\App\Question::class, function (Faker $faker) {
    return [
        'asker_id' => $faker->randomElement(\App\User::pluck('id')->toArray()),
        'title' => $faker->paragraph(4),
        'description' => $faker->paragraph(10)
    ];
});
