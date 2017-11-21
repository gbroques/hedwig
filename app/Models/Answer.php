<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;


class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'question_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
