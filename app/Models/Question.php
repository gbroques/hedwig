<?php

namespace App\Models;

use App\Models\Answer;
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

    public function answers()
    {
        return $this->belongsToMany(Answer::class);
    }
}
