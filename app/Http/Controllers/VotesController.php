<?php

namespace App\Http\Controllers;

use App\Vote;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    /*
     * Auth user instance.
     */
    protected $authUser;

    /**
    * Create new controller instance.
    *
    * VotesController constructor.
    */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authUser = Auth::user();
            return $next($request);
        });
    }

    /**
     * Voting a question or answer.
     *
     * @param $action
     * @param $modelStr
     * @param $modelValue
     * @return array|string
     */
    public function vote($action, $modelStr, $modelValue)
    {
        $modelName =  "App\\{$modelStr}";
        $model = $modelName::find($modelValue);
        $data = [
            'voter_id'       => $this->authUser->id,
            'votable_id'    => $modelValue,
            'votable_type'  => $modelName,
            'count'         => $action == 'up' ? '1' : '-1'
        ];

        $response = [];

        if ($modelStr == 'Question') {
            if($this->authUser->ownsQuestion($modelValue)) {
                $response['voteCount'] = $model->votesCount();
                $response['message'] = 'You cannot vote your own post';
                return $response;
            }
        } elseif($modelStr == 'Answer' && $this->authUser->ownsQuestion($model->question->id)) {
            if($this->authUser->ownsAnswer($modelValue)) {
                $response['voteCount'] = $model->votesCount();
                $response['message'] = 'You cannot vote your own post';
                return $response;
            }
        }

        if($action == 'up')  {
            if(!$this->authUser->upVoted($model)) {
                $this->authUser->deletePreviousVote($model);
                $vote = Vote::create($data);
                $model->votes()->save($vote);
                $response['voteCount'] = $model->votesCount();
                $response['message'] = 'Successfully upvoted the ' . $modelStr;
            } else {
                return $response['message'] = 'Already upvoted';
            }
        } else if($action == 'down') {
            if(!$this->authUser->downVoted($model)) {
                $this->authUser->deletePreviousVote($model);
                $vote = Vote::create($data);
                $model->votes()->save($vote);
                $response['voteCount'] = $model->votesCount();
                $response['message'] = 'Successfully downvoted  the ' . $modelStr;
            } else {
                return $response['message'] = 'Already downvoted';
            }
        }

        return $response;
    }
}
