<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentsController extends Controller
{
    /*
     * Authenticated user instance.
     */
    protected $authUser;

    /**
     * CommentsController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->middleware('auth');
            $this->authUser = Auth::user();
            return $next($request);
        });
    }

    /**
     * Persisting comment to database.
     *
     * @return array
     */
    public function comment()
    {
        $commentText = request()->input('data.commentText');
        $modelStr = request()->input('data.modelName');
        $modelId = request()->input('data.modelId');
        $modelNamesSpaced =  "App\\{$modelStr}";
        $model = $modelNamesSpaced::find($modelId);

        $comment = Comment::create([
            'commenter_id'      => $this->authUser->id,
            'commentable_id'    => $modelId,
            'commentable_type'  => $modelNamesSpaced,
            'body'              => $commentText
        ]);

        $model->comments()->save($comment);

        return [
            'commentIdFor' => $comment->commentable->id,
            'commentableType' => $modelStr,
            'commentVotesCount' => $comment->votesCount(),
            'commentText' => $comment->body,
            'commenterId' => $comment->user->id,
            'commenter' => $comment->user->name,
            'commentDate' => $comment->created_at->diffForHumans()
        ];
    }
}
