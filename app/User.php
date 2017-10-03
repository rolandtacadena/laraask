<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'self_description',
        'email',
        'password',
        'address',
        'reputation'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Scope a query to order results to newest.
     *
     * @param $query
     * @return mixed
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to order results to oldest.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOldest($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    /**
     * A user can ask many questions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'asker_id');
    }

    /**
     * User questions count.
     *
     * @return mixed
     */
    public function questionsCount()
    {
        return $this->questions->count();
    }

    /**
     * Check if user has at least 1 question.
     *
     * @return bool
     */
    public function hasQuestions()
    {
        return $this->questionsCount() > 0;
    }

    /**
     * Check if the user owns the given question.
     *
     * @param $questionId
     * @return mixed
     */
    public function ownsQuestion($questionId)
    {
        return $this->questions->contains('id', $questionId);
    }

    /**
     * A user can have many answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class, 'answerer_id');
    }

    /**
     * Check if the user owns the given answer.
     *
     * @param $answerId
     * @return mixed
     */
    public function ownsAnswer($answerId)
    {
        return $this->answers->contains('id', $answerId);
    }

    /**
     * User answers count.
     *
     * @return mixed
     */
    public function answersCount()
    {
        return $this->answers->count();
    }

    /**
     * Check is the user has at least 1 answer.
     *
     * @return bool
     */
    public function hasAnswers()
    {
        return $this->answersCount() > 0;
    }

    /**
     * Accept the answer for his/her question.
     *
     * @param $answerId
     * @return mixed
     */
    public function acceptAnswer($answerId)
    {
        $answer = Answer::findOrFail($answerId);
        return $answer->makeAccepted();
    }

    /**
     * Unaccept the answer for his/her question.
     *
     * @param $answerId
     * @return mixed
     */
    public function unAcceptAnswer($answerId)
    {
        $answer = Answer::findOrFail($answerId);
        return $answer->makeUnaccepted();

    }

    /**
     * Clear previously accepted answer for the given question.
     *
     * @param $questionId
     * @return mixed
     */
    public function clearAcceptedAnswerForQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $acceptedAnswerId = $question->acceptedAnswer();

        return $this->unAcceptAnswer($acceptedAnswerId);
    }

    /**
     * A user can make many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'commenter_id');
    }

    /**
     * User favorite questions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteQuestions()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    /**
     * Count user favorites.
     *
     * @return mixed
     */
    public function favoriteQuestionsCount()
    {
        return $this->favoriteQuestions()->count();
    }

    /**
     * Check if user has atleast favorite questions.
     *
     * @return bool
     */
    public function hasFavorites()
    {
        return $this->favoriteQuestionsCount() > 0;
    }

    /**
     * If a user favorite the question.
     *
     * @param $question_id
     * @return mixed
     */
    public function favorTheQuestion($question_id)
    {
        return $this->favoriteQuestions->contains($question_id);
    }

    /**
     * User votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(Vote::class, 'voter_id');
    }

    /**
     * User votes count.
     *
     * @return mixed
     */
    public function votesCount()
    {
        return $this->votes->count();
    }

    /**
     * Check if user has atleat 1 vote casted.
     *
     * @return bool
     */
    public function hasVotes()
    {
        return $this->votesCount() > 0;
    }

    /**
     * If a user already voted the given entity. (question/answer).
     *
     * @param $model
     * @return bool
     */
    public function upVoted($model)
    {
        return $this->votes()
                ->where('votable_id', $model->id)
                ->where('votable_type', get_class($model))
                ->where('count', '1')
                ->get()
                ->count() == 1;
    }

    /**
     * If a user already downvoted the given entity. (question/answer).
     *
     * @param $model
     * @return bool
     */
    public function downVoted($model)
    {
        return $this->votes()
                ->where('votable_id', $model->id)
                ->where('votable_type', get_class($model))
                ->where('count', '-1')
                ->get()
                ->count() == 1;
    }

    /**
     * Get all upvotes.
     *
     * @return mixed
     */
    public function upVotedPosts()
    {
        return $this->votes()->where('count', 1);
    }

    /**
     * Get all upvotes for given model.
     *
     * @param $modelStr
     * @return mixed
     */
    public function upVotedPostFor($modelStr)
    {
        return $this->votes()->where('votable_type', 'App\\' . $modelStr)->get();
    }

    /**
     * Count all upvotes.
     *
     * @return mixed
     */
    public function upVotedPostsCount()
    {
        return $this->upVotedPosts()->get()->count();
    }

    /**
     * Get all downvotes for given model.
     *
     * @return mixed
     */
    public function downVotedPosts()
    {
        return $this->votes()->where('count', -1);
    }

    /**
     * Get all downvotes for given model.
     *
     * @param $modelStr
     * @return mixed
     */
    public function downVotedPostFor($modelStr)
    {
        return $this->votes()->where('votable_type', 'App\\' . $modelStr)->get();
    }

    /**
     * Count downvotes.
     *
     * @return mixed
     */
    public function downVotedPostsCount()
    {
        return $this->downVotedPosts()->get()->count();
    }

    /**
     * Remove the vote.
     *
     * @param $model
     * @return mixed
     */
    public function deletePreviousVote($model)
    {
        return $this->votes()
            ->where('votable_id', $model->id)
            ->where('votable_type', get_class($model))
            ->delete();
    }

    /**
     * Get all tags used by the user on his questions.
     *
     * @return array|\Illuminate\Support\Collection|static
     */
    public function usedTags()
    {
        $tags = [];

        foreach ($this->questions as $question) {
            foreach ($question->tags as $tag) {
                $tags[$tag->id] = $tag;
            }
        }

        return collect($tags)->unique();

    }

    /**
     * Count user's used tags.
     *
     * @return int
     */
    public function usedTagsCount()
    {
        return $this->usedTags()->count();
    }

    /**
     * Check if user has used at least 1 tag.
     *
     * @return bool
     */
    public function hasUsedTags()
    {
        return $this->usedTagsCount() > 0;
    }

    /**
     * User favorite tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteTags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Add user fav tags.
     *
     * @param $tags
     * @return array
     */
    public function addFavoriteTags($tags)
    {
        return $this->favoriteTags()->syncWithoutDetaching($tags);
    }

    /**
     * Check if at least one of user favorite tags exists on question's tags.
     *
     * @param Question $question
     * @return bool
     */
    public function hasFavoriteTagOnQuestion(Question $question)
    {
        $userTagIds = $this->favoriteTags->pluck('id')->toArray();
        $questionTags = $question->tags->pluck('id')->toArray();

        return count(array_intersect($questionTags, $userTagIds)) > 0 ? true : false;
    }
}
