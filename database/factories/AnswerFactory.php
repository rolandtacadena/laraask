<?php

use Faker\Generator as Faker;

$factory->define(\App\Answer::class, function (Faker $faker) {
    return [
        'question_id' => $faker->randomElement(\App\Question::pluck('id')->toArray()),
        'answerer_id' => $faker->randomElement(\App\User::pluck('id')->toArray()),
        'answer' => $faker->paragraph(10),
        'accepted' => false
    ];
});
