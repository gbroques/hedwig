<?php

namespace App\Http\Controllers\Lesson;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Lesson\paginate;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $lessonId The ID or slug of the lesson
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $lessonId)
    {
        $playlistItemId = $request->input('youtube_playlist_item_id');
        $orderBy = $request->input('orderBy');

        return Question::whereHas('lesson', function ($q) use ($lessonId) {
                           return $q->where('id', $lessonId)
                                    ->orWhere('slug', $lessonId);
                       })->when($playlistItemId, function ($q) use ($playlistItemId) {
                           return $q->where('youtube_playlist_item_id', $playlistItemId);
                       })->when($orderBy, function ($q) use ($orderBy) {
                           $orderByParts = explode(',', $orderBy);
                           $field = $orderByParts[0];
                           $order = $orderByParts[1];
                           return $q->orderBy($field, $order);
                       })->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @param  int $lessonId  The ID of the lesson
     * @return \Illuminate\Http\Response
     */
    public function show($lessonId, Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lessonId The ID of the lesson
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lessonId, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $lessonId The ID of the lesson
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($lessonId, Question $question)
    {
        //
    }
}
