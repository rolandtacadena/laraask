<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'answerer_id',
        'answer',
        'accepted'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['question'];


    /**
     * The answer is answered by user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'answerer_id');
    }

    /**
     * The question for the answer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Does this answer flagged as accepted.
     *
     * @return bool
     */
    public function isAccepted()
    {
        return $this->accepted == true;
    }

    /**
     * Change answer status to accepted.
     *
     * @return bool
     */
    public function makeAccepted()
    {
        $this->accepted = true;
        return $this->save();
    }

    /**
     * Change answer status to unaccepted.
     *
     * @return bool
     */
    public function makeUnaccepted()
    {
        $this->accepted = false;
        return $this->save();
    }

    /**
     * Check if the answer is the
     * accepted answer for given question
     *
     * @param $questionId
     * @return mixed
     */
    public function isAcceptedAnswerForQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);

        if($this->question->id == $question->id) {
            return $question->acceptedAnswerIs($this->id);
        }
    }

    /**
     * Get all of the answer's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all votes for answer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    /**
     * Get votes count for answer.
     *
     * @return mixed
     */
    public function votesCount()
    {
        return $this->votes->sum('count');
    }
}
