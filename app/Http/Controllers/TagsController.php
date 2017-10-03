<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;

class TagsController extends Controller
{
    /**
     * View all tags paginated.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $allTags = Tag::paginate(10);
        return view('tags', compact('allTags'));
    }

    /**
     * Show tag questions and details.
     *
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Tag $tag)
    {
        $taggedQuestions = $tag->questions()->latest()->paginate(15);
    	return view('tag', compact('tag', 'taggedQuestions'));
    }

    /**
     * Get all tags.
     *
     * @return mixed
     */
    public function all()
    {
        return Tag::all();
    }

    /**
     * Get all favorite tags for user.
     *
     * @param User $user
     * @return mixed
     */
    public function for_user(User $user)
    {
        return $user->favoriteTags;
    }
}
