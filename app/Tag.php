<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    /**
     * Query scope for latest questions.
     *
     * @param $query
     * @return mixed
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Query scope for oldest questions.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOldest($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    /**
     * The questions the tag was used.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Get the tag's question count.
     *
     * @return mixed
     */
    public function questionsCount()
    {
        return $this->questions->count();
    }

    /**
     * Tag questions filtered by user.
     *
     * @param $userId
     * @return mixed
     */
    public function questionsByUser($userId)
    {
        return $this->questions()->where('asker_id', $userId);
    }

    /**
     * Count tag questions filtered by user
     *
     * @return mixed
     */
    public function questionsCountByUser($userId)
    {
        return $this->questionsByUser($userId)->count();
    }

    /**
     * Return all questions tagged as this tag today.
     *
     * @return mixed
     */
    public function questionsAskedToday()
    {
        return $this->questions()
            ->whereDate('question_tag.created_at', Carbon::today()->toDateString())
            ->latest();
    }

    /**
     * Count all questions tagged as this tag today.
     *
     * @return mixed
     */
    public function countQuestionsAskedToday()
    {
        return $this->questionsAskedToday()->get()->count();
    }

    /**
     * Return all questions tagged as this tag this month.
     *
     * @return mixed
     */
    public function questionsAskedThisMonth()
    {
        return $this->questions()
            ->whereMonth('question_tag.created_at', Carbon::now()->month)
            ->latest();
    }

    /**
     * Count all questions tagged as this tag this month.
     *
     * @return mixed
     */
    public function countQuestionsAskedThisMonth()
    {
        return $this->questionsAskedThisMonth()->get()->count();
    }

    /**
     * Get related tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function related()
    {
        $tags = $this->tags()->pluck('tag_id');
        return $this->belongsToMany(Tag::class)->wherePivotIn('tag_id', $tags);
    }
}
