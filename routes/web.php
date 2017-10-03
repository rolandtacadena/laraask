<?php

Auth::routes();

Route::get('/', 'QuestionsController@index')
    ->name('index');

Route::get('questions', 'QuestionsController@all')
    ->name('all-questions');

Route::get('unanswered', 'QuestionsController@unanswered')
    ->name('unanswered-questions');

Route::get('question/{question}', 'QuestionsController@show')
    ->name('question-show');

Route::get('questions/related-to/{question}', 'QuestionsController@related')
    ->name('related-questions');

Route::get('ask-question', 'QuestionsController@create')
    ->name('ask-question');

Route::post('ask-question', 'QuestionsController@store')
    ->name('ask-question');

Route::get('questions-by-tag-{tag}-user-{user}', 'QuestionsController@getQuestionsByTagUser')
    ->name('question-tag-user');

Route::get('questions-today-by-tag-{tag}', 'QuestionsController@questionsTodayByTag')
    ->name('question-today-by-tag');

Route::get('questions-this-month-by-tag-{tag}', 'QuestionsController@questionsThisMonthByTag')
    ->name('question-this-month-by-tag');

Route::post('answer-question', 'AnswersController@store')
    ->name('answer-question');

Route::get('tags', 'TagsController@index')
    ->name('tags');

Route::get('tags/{tag}', 'TagsController@show')
    ->name('tag-show');

Route::get('users', 'UsersController@index')
    ->name('users');

Route::get('users/{user}', 'UsersController@showUserProfile')
    ->name('user-show');

Route::get('users/{user}/edit', 'UsersController@editUserProfile')
    ->name('user-edit');

Route::patch('users/{user}', 'UsersController@updateUserProfile')
    ->name('user-update');

Route::get('how-it-works', 'StaticPagesController@howItWorks')
    ->name('how-it-works');

Route::get('about', 'StaticPagesController@about')
    ->name('about');

// AJAX Routes
Route::prefix('ajax')->group(function () {
    Route::get('vote/{type}/{model}/{modelValue}', 'VotesController@vote');
    Route::post('comment', 'CommentsController@comment');
    Route::get('favorite/question/{question_id}', 'UsersController@makeQuestionFavorite');
    Route::get('accept/answer/{answer_d}', 'UsersController@acceptAnswer');
    Route::get('tags/all', 'TagsController@all');
    Route::get('tags/user/{user}', 'TagsController@for_user');
    Route::get('user/remove-tag/{tag}', 'UsersController@remove_tag');
    Route::post('user/add-tags', 'UsersController@add_tag');
    Route::get('check-if-authenticated', 'UsersController@check_if_authenticated');
    Route::get('get-auth-user', 'UsersController@get_auth_user');
});
