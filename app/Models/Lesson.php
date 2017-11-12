<?php

namespace App\Models;

use App\Models\Course;
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
}
