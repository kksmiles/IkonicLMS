<?php

namespace App\Http\Controllers;

use App\Models\CourseMaterial;
use App\Models\CourseMaterialTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CourseMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_materials = CourseMaterial::all();
        return view('course-materials.index', compact('course_materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $course_material_topics = CourseMaterialTopic::where('course_id', $request->course_id)->get();
        $current_course_material_topic = CourseMaterialTopic::find($request->topic);
        return view('course-materials.create', compact('course_material_topics', 'current_course_material_topic'));
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
            'course_material_topic_id' => ['numeric'],
            'title' => ['string', 'required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'course_material_file' => ['nullable', 'mimes:pdf,ppt,mp4,3GP,OGG']
        ]);

        if($request->hasFile('course_material_file')) {
            $current_time = \Carbon\Carbon::now()->timestamp;
            $extension = $request->course_material_file->extension();
            $request->course_material_file->storeAs('/public/course-materials', $current_time."".$attributes['title'].".".$extension);
            $url = Storage::url("course-materials/".$current_time."".$attributes['title'].".".$extension);
            $attributes['course_material_file']=$url;
        }

        CourseMaterial::create($attributes);
        $course_id = CourseMaterialTopic::find($request->course_material_topic_id)->course_id;
        return redirect(route('courses.show', $course_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseMaterial  $course_material
     * @return \Illuminate\Http\Response
     */
    public function show(CourseMaterial $course_material)
    {
        return view('course-materials.show', compact('course_material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseMaterial  $course_material
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseMaterial $course_material)
    {
        $course_material_topics = CourseMaterialTopic::where('course_id', $course_material->course_material_topic->course->id)->get();
        return view('course-materials.edit', compact('course_material', 'course_material_topics'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseMaterial  $course_material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseMaterial $course_material)
    {
        $attributes = $request->validate([
            'course_material_topic_id' => ['numeric'],
            'title' => ['string', 'required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'course_material_file' => ['nullable', 'mimes:pdf,ppt,mp4,3GP,OGG']
        ]);

        if($request->hasFile('course_material_file')) {
            $current_time = \Carbon\Carbon::now()->timestamp;
            $extension = $request->course_material_file->extension();
            $request->course_material_file->storeAs('/public/course-materials', $current_time."".$attributes['title'].".".$extension);
            $url = Storage::url("course-materials/".$current_time."".$attributes['title'].".".$extension);
            $attributes['course_material_file']=$url;
            $course_material->image = $attributes['course_material_file'];
        }

        $course_material->course_material_topic_id = $attributes['course_material_topic_id'];        
        $course_material->title = $attributes['title'];        
        $course_material->description = $attributes['description'];        
        $course_material->save();        

        return redirect(route('course-materials.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseMaterial  $course_material
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseMaterial $course_material)
    {
        $course_id = $course_material->course_material_topic->course->id;
        $course_material->delete();
        return redirect(route('courses.show', $course_id));
    }
}
