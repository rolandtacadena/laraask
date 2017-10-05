<?php

use Faker\Generator as Faker;

$factory->define(\App\Question::class, function (Faker $faker) {
    return [
        'asker_id' => $faker->randomElement(\App\User::pluck('id')->toArray()),
        'title' => $faker->paragraph(3),
        'description' => $faker->paragraph(6)
    ];
});
