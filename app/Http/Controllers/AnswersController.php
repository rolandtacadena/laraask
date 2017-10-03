<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Requests\CreateAnswerRequest;

class AnswersController extends Controller
{
    /**
     * AnswersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Persisting answer to database
     *
     * @param CreateAnswerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAnswerRequest $request)
    {
        $request->persist();

        return redirect()->route('question-show', $request->input('question_id'));
    }
}
