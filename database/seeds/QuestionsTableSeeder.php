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
            $tagIds = Tag::pluck('id')->toArray();
            $randomKey = array_rand($tagIds);
            $question->tags()->attach($tagIds[$randomKey]);
         });
    }
}
