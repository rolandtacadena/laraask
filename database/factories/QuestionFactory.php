<?php

use Faker\Generator as Faker;

$factory->define(\App\Question::class, function (Faker $faker) {
    return [
        'asker_id' => $faker->numberBetween(1, 10),
        'title' => $faker->paragraph(3),
        'description' => $faker->paragraph(6)
    ];
});
