<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignments = Assignment::all();
        return view('assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assignments.create');
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
            'full_grade' => ['required', 'numeric'],
            'due_date' => ['required', 'date'],
            'assignment_file' => ['nullable', 'mimes:pdf,ppt']
        ]);

        if($request->hasFile('assignment_file')) {
            $current_time = \Carbon\Carbon::now()->timestamp;
            $extension = $request->assignment_file->extension();
            $request->assignment_file->storeAs('/public/assignments', $current_time."".$attributes['title'].".".$extension);
            $url = Storage::url("assignments/".$current_time."".$attributes['title'].".".$extension);
            $attributes['assignment_file']=$url;
        }

        Assignment::create($attributes);
        return redirect(route('assignments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        return view('assignments.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        return view('assignments.edit', compact('assignment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        $attributes = $request->validate([
            'course_material_topic_id' => ['numeric'],
            'title' => ['string', 'required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'full_grade' => ['required', 'numeric'],
            'due_date' => ['required', 'date'],
            'assignment_file' => ['nullable', 'mimes:pdf,ppt']
        ]);

        if($request->hasFile('assignment_file')) {
            $current_time = \Carbon\Carbon::now()->timestamp;
            $extension = $request->assignment_file->extension();
            $request->assignment_file->storeAs('/public/assignments', $current_time."".$attributes['title'].".".$extension);
            $url = Storage::url("assignments/".$current_time."".$attributes['title'].".".$extension);
            $attributes['assignment_file']=$url;
            $assignment->assignment_file = $attributes['assignment_file'];
        }

        $assignment->course_material_topic_id = $attributes['course_material_topic_id'];        
        $assignment->title = $attributes['title'];        
        $assignment->description = $attributes['description'];        
        $assignment->full_grade = $attributes['full_grade'];        
        $assignment->due_date = $attributes['due_date'];        
        $assignment->save(); 
        return redirect(route('assignments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        return redirect(route('assignments.index'));
    }
}
