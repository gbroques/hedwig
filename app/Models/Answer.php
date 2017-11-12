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
    protected $fillable = ['text'];

    public function questions()
    {
        return $this->belongsTo(Question::class);
    }
}
