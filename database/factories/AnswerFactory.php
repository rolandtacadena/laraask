<?php

use Faker\Generator as Faker;

$factory->define(\App\Answer::class, function (Faker $faker) {
    return [
        'question_id' => $faker->numberBetween(1, 10),
        'answerer_id' => $faker->numberBetween(1, 10),
        'answer' => $faker->paragraph(10),
        'accepted' => false
    ];
});
