<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $courseId
     * @return \Illuminate\Http\Response
     */
    public function index($courseId)
    {
        return Course::with('lessons')
                     ->where('id', $courseId)
                     ->firstOrFail();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Lesson::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $courseId
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show($courseId, Lesson $lesson)
    {
        return $lesson;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $courseId
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $courseId, Lesson $lesson)
    {
        $lesson->update($request->all());
        return $lesson;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $courseId
     * @param  int  $lessonId
     * @return \Illuminate\Http\Response
     */
    public function destroy($courseId, $lessonId)
    {
        return Lesson::destroy($lessonId);
    }
}
