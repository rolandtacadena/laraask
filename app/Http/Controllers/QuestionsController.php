<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Answer;
use App\Question;
use App\Http\Requests\CreateQuestionRequest;

class QuestionsController extends Controller
{
    /**
     * QuestionsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    /**
     * Index.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $questions = Question::latest();

        if(request()->has('sort')) {
            $sortStr = request('sort');
            $questions = $this->sortBy($questions, $sortStr);
        }

        $questions = $questions->paginate(10);

        return view('index', compact('questions'));
    }

    /**
     * Display all questions.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $questions = Question::latest();

        if(request()->has('sort')) {
            $sortStr = request('sort');
            $questions = $this->sortBy($questions, $sortStr);
        }

        $questions = $questions->paginate(10);

        return view('all-questions', compact('questions'));
    }

    /**
     * Display questions asked today by a given tag.
     *
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questionsTodayByTag(Tag $tag)
    {
        $questions = $tag->questionsAskedToday();

        if(request()->has('sort')) {
            $sortStr = request('sort');
            $questions = $this->sortBy($questions, $sortStr);
        }

        $questions = $questions->paginate(10);

        return view('get-questions-today-by-tag', compact('tag', 'questions'));
    }

    /**
     * Display questions asked thus month by a given tag.
     *
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questionsThisMonthByTag(Tag $tag)
    {
        $questions = $tag->questionsAskedThisMonth();

        if(request()->has('sort')) {
            $sortStr = request('sort');
            $questions = $this->sortBy($questions, $sortStr);
        }

        $questions = $questions->paginate(10);

        return view('get-questions-this-month-by-tag', compact('tag', 'questions'));
    }

    /**
     * Get questions by given user and tag.
     *
     * @param Tag $tag
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getQuestionsByTagUser(Tag $tag, User $user)
    {
        $questions = $tag->questionsByUser($user->id);

        if(request()->has('sort')) {
            $sortStr = request('sort');
            $questions = $this->sortBy($questions, $sortStr);
        }

        $questions = $questions->paginate(10);

        return view('questions-by-tag-user', compact('questions', 'tag', 'user'));
    }

    /** Unanswered questions.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unanswered()
    {
        $questions = $this->unAnsweredQuestions();

        if(request()->has('sort')) {
            $sortStr = request('sort');
            $questions = $this->sortBy($questions, $sortStr);
        }

        $questions = $questions->paginate(10);

        return view('unanswered-questions', compact('questions'));
    }

    /**
     * Get all unanswered questions.
     *
     * @return mixed
     */
    public function unAnsweredQuestions()
    {
        $acceptedAnswers = Answer::where('accepted', true)->pluck('question_id');
        return $questions = Question::whereNotIn('id', $acceptedAnswers);
    }

    /**
     * Show the question.
     *
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Question $question)
    {
        return view('show-question', compact('question'));
    }

    /**
     * Create question form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tags = Tag::pluck('id', 'name');
        return view('ask-question', compact('tags'));
    }

    /**
     * Storing question.
     *
     * @param CreateQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateQuestionRequest $request)
    {
        $question = $request->persist();

        flash()->success('Question created.', 'You have successfully created a new question!');

        return redirect()->route('question-show', $question);
    }

    /**
     * Related question.
     *
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function related(Question $question)
    {
        $relatedQuestions = $question->relatedQuestions();

        return view('related-questions', compact('question', 'relatedQuestions'));
    }

    /**
     * Sort questions by 'sort' query string.
     *
     * @param $sortStr
     * @return mixed
     */
    public function sortBy($questions, $sortStr)
    {
        if ($sortStr == 'active') {
            $questions = $questions->active();
        }

        if ($sortStr == 'newest') {
            $questions = $questions->latest();
        }

        if ($sortStr == 'oldest') {
            $questions = $questions->oldest();
        }

        return $questions;
    }
}
