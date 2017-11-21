<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'youtube_playlist_item_id',
        'lesson_id'
    ];

    /**
     * Get the answers associated with a question.
     */
    public function answers()
    {
        return $this->belongsToMany(Answer::class);
    }

    /**
     * Get the lesson associated with a question.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
