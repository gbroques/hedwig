<?php

namespace App\Models;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getImageAttribute($value)
    {
      return 'img/' . $value;
    }

    /**
     * Get the lessons associate with a course.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

}
