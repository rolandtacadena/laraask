<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'voter_id',
        'votable_id',
        'votable_type',
        'count'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['votable'];

    /**
     * Get all of the owning commentable models.
     */
    public function votable()
    {
        return $this->morphTo();
    }

    /**
     * Return the voter of the question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voter()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }

}
