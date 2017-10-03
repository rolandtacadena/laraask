<?php

use App\Question;
use App\Tag;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(Question::class, 100)->create()->each(function ($question) {
             $question->tags()->attach(range(1, Tag::count()));
         });
    }
}
