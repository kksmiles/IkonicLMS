<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseMaterialTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
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
            'department_id' => ['numeric'],
            'title' => ['string', 'required', 'unique:courses', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]);
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('image')) {
            $image_name = $current_timestamp . "_" . $request->image->getClientOriginalName();
            $extension = $request->image->extension();
            $request->image->storeAs('/public/courses', $image_name .".". $extension);
            $url = Storage::url("courses/". $image_name .".". $extension);
            $attributes['image']=$url;
        }

        $course = Course::create($attributes);
        $course_material_topic = new CourseMaterialTopic;
        $course_material_topic->course_id = $course->id;
        $course_material_topic->title = "Announcements";
        $course_material_topic->hidden = 0;
        $course_material_topic->save();
        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
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
        $attributes = $request->validate([
            'department_id' => ['numeric'],
            'title' => ['string', 'required', Rule::unique('courses')->ignore($course->id), 'max:255'],
            'description' => ['nullable', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]);

        if($request->hasFile('image')) {
            $extension = $request->image->extension();
            $request->image->storeAs('/public/courses', $attributes['title'].".".$extension);
            $url = Storage::url("courses/".$attributes['title'].".".$extension);
            $attributes['image']=$url;
            $course->image = $attributes['image'];
        }

        $course->department_id = $attributes['department_id'];        
        $course->title = $attributes['title'];
        $course->description = $attributes['description'];
        $course->start_date = $attributes['start_date'];
        $course->end_date = $attributes['end_date'];
        $course->save();
        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect(route('courses.index'));
    }
}
