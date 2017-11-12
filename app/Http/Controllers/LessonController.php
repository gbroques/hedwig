<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Lesson::all();
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
     * Display the specified lesson.
     * Optionally request relations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $lessonId  ID or slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $lessonId)
    {
        $with = [];
        if (!empty($request->input('with'))) {
            $with = $request->input('with');
        }
        return Lesson::where('id', $lessonId)
                     ->orWhere('slug', $lessonId)
                     ->with($with)
                     ->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $lesson->update($request->all());
        return $lesson;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $success = $lesson->delete();
        return response()->json([
            'success' => $success
        ]);
    }
}
