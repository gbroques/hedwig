<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'youtube_playlist_id',
        'course_id'
    ];

    /**
     * Get the course associated with a lesson.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the questions associated with a lesson.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
