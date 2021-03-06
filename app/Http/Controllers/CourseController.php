<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Course::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Course::create($request->all());
    }

    /**
     * Display the specified resource.
     * Optionally request relations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $courseId  ID or slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $courseId)
    {
        $with = $request->input('with');
        return Course::where('id', $courseId)
                     ->orWhere('slug', $courseId)
                     ->when($with, function ($q) use ($with) {
                         return $q->with($with);
                     })->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
        return $course;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $success = $course->delete();
        return response()->json([
            'success' => $success
        ]);
    }
}
