<?php

namespace App\Http\Controllers;

use App\Models\CourseMaterialTopic;
use App\Models\Course;
use Illuminate\Http\Request;


class CourseMaterialTopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
        $this->authorizeResource(CourseMaterialTopic::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_material_topics = CourseMaterialTopic::all();
        return view('course-material-topics.index', compact('course_material_topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $course = Course::find($request->course_id);
        return view('course-material-topics.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'course_id' => ['numeric'],
            'title' => ['string', 'required', 'max:255'],
            'description' => ['nullable', 'max:255'],
        ]);
        CourseMaterialTopic::create($attributes);
        $course_id = Course::find($request->course_id);
        return redirect(route('courses.show', $course_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseMaterialTopic  $course_material_topic
     * @return \Illuminate\Http\Response
     */
    public function show(CourseMaterialTopic $course_material_topic)
    {
        return view('course-material-topics.show', compact('course_material_topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseMaterialTopic  $course_material_topic
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseMaterialTopic $course_material_topic)
    {
        return view('course-material-topics.edit', compact('course_material_topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseMaterialTopic  $course_material_topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseMaterialTopic $course_material_topic)
    {
        $attributes = $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'description' => ['nullable', 'max:255'],
        ]);
     
        $course_material_topic->title = $attributes['title'];        
        $course_material_topic->description = $attributes['description'];             
        $course_material_topic->save();

        $course_id = Course::find($course_material_topic->course_id);
        return redirect(route('courses.show', $course_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseMaterialTopic  $course_material_topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseMaterialTopic $course_material_topic)
    {
        $course_material_topic->delete();
        return redirect(route('course-material-topics.index'));
    }
}
