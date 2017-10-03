<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asker_id',
        'title',
        'description'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Active scope based on updated_at column.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    /**
     * A question is asked by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'asker_id');
    }

    /**
     * Check if the question is owned by the given user.
     *
     * @param $userId
     * @return bool
     */
    public function isOwnedByUser($userId)
    {
        return $this->user->id == $userId;
    }

    /**
     * A question can have many answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Get the accepted answer for this question.
     *
     * @return mixed
     */
    public function acceptedAnswer()
    {
        return $this->answers()->where('accepted', true)->value('id');
    }

    /**
     * Check if the question has
     * already accepted answer.
     *
     * @return bool
     */
    public function hasAcceptedAnswerAlready()
    {
        return $this->answers()->where('accepted', true)->count() > 0;
    }

    /**
     * Check if the given answer is the
     * accepted answer for the question.
     *
     * @param $answerId
     * @return mixed
     */
    public function acceptedAnswerIs($answerId)
    {
        $answer = Answer::findOrFail($answerId);

        if($this->answers->contains('id', $answer->id)) {
            return $answer->isAccepted();
        }
    }

    /**
     * Get all of the question's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all votes for question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    /**
     * The tags for question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Get all answers count for the question.
     *
     * @return mixed
     */
    public function answersCount()
    {
        return $this->answers->count();
    }

    /**
     *
     * Get votes count for question.
     * @return mixed
     */
    public function votesCount()
    {
        return $this->votes->sum('count');
    }

    /**
     * Return the users who favor this question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userHasFavoriteOn()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    /**
     * Count users who favorite the given question.
     *
     * @return mixed
     */
    public function countUserHasFavoriteOn()
    {
        return $this->userHasFavoriteOn->count();
    }

    /**
     * Check if the question is favorite by the user.
     *
     * @param $user_id
     * @return mixed
     */
    public function isFavoredByUser($user_id)
    {
        return $this->userHasFavoriteOn->contains($user_id);
    }

    /**
     * Last active date of the question.
     *
     * @return mixed
     */
    public function lastActiveDate()
    {
        return $this->updated_at->diffForHumans();
    }


    /**
     * Get all the question tags and then
     * for each tags get its questions.
     * Store in array and filter the unique values.
     *
     * @return static
     */
    public function relatedQuestions()
    {
        $questions = [];

        foreach ($this->tags as $tag) {
            foreach ($tag->questions as $question) {
                $questions[$question->id] = $question;
            }
        }

        // remove the question on array, just the related questions.
        unset($questions[$this->id]);

        return collect($questions)->unique();
    }
}
