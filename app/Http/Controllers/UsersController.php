<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Answer;
use App\Question;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /*
     * Authenticated user.
     */
    protected $authUser;

    /**
     * Create new controller instance.
     *
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->middleware('auth')->except(['index', 'showUserProfile', 'check_if_authenticated']);
            $this->authUser = Auth::user();
            return $next($request);
        });
    }

    /**
     * Paginated user results.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $allUsers = User::paginate(30);
        return view('users', compact('allUsers'));
    }

    /**
     * Show user profile.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUserProfile(User $user)
    {
        return view('user-profile', compact('user'));
    }

    /**
     * Show edit form.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editUserProfile(User $user)
    {
        return view('edit-user-profile', compact('user'));
    }

    /**
     * Update user profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserProfile()
    {
        $this->validate(request(), [
            'name' => 'required|max:255'
        ], ['name.required' => 'You cannot leave your name blank.']);

        $this->authUser->update(request()->all());

        flash()->success('Update Profile', 'You have successfully updated your profile.');

        return redirect()->route('user-show',  $this->authUser);
    }

    /**
     * Make the question favorite.
     *
     * @param $questionId
     * @return array
     */
    public function makeQuestionFavorite($questionId)
    {
        $question = Question::find($questionId);
        $favorites = $this->authUser->favoriteQuestions();
        $response = [];

        if($this->authUser->favorTheQuestion($questionId)) {
            $favorites->detach($questionId);
            $response['message'] = 'unstar';
        } else {
            $favorites->attach($questionId);
            $response['message'] = 'starred';
        }

        $response['starCount'] = $question->countUserHasFavoriteOn();

        return $response;
    }

    /**
     * Toggle accepting answer.
     *
     * @param $answerId
     * @return array
     */
    public function acceptAnswer($answerId)
    {
        $answer = Answer::findOrFail($answerId);
        $response = [];

        if($answer->isAccepted()) {
            $this->authUser->unAcceptAnswer($answer->id);
            $response['action'] = 'unaccept';
            $response['message'] = 'You have already been accepted this answer.';
        } else {
            $this->authUser->acceptAnswer($answer->id);
            $response['action'] = 'accept';
            $response['message'] = 'Answer successfully accepted';
        }

        return $response;
    }

    /**
     * Remove tag by id.
     *
     * @param $tagId
     * @return mixed
     */
    public function remove_tag($tagId) {
        $this->authUser->favoriteTags()->detach($tagId);
        return $tagId;
    }

    /**
     * Add user favorite tags.
     *
     * @return array
     */
    public function add_tag()
    {
        $addedTags = $this->authUser->addFavoriteTags(request('tagsToAdd'));
        $attachedIds = $addedTags['attached'];

        $response = [];
        $response['attachedCount'] = count($attachedIds);

        if($attachedIds) {
            $response['tagObjects'] = Tag::whereIn('id', $attachedIds)->get();
        }

        return $response;
    }

    /**
     * Check if user is authenticated.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_if_authenticated()
    {
        return response()->json(auth()->check());
    }

    /**
     * Get the authenticated user object.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_auth_user()
    {
        if( ! auth()->check()) {
            return response()->json([
                'error' => 'No authenticated user found'
            ]);
        }

        return response()->json([
            'authUser' => [
                'id' => auth()->id(),
                'name' => auth()->user()->name,
                'email' => auth()->user()->email
            ]
        ]);
    }
}
