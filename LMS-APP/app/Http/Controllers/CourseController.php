<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\CourseMaterialTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');   
        $this->authorizeResource(Course::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $courses = Course::paginate(8);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = \App\Models\Department::all('id', 'name');
        return view('courses.create', compact('departments'));
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
            'description' => ['nullable'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
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
        return redirect(route('courses.index'))->with('success', 'Course created successfully');
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
        $departments = \App\Models\Department::all('id', 'name');
        return view('courses.edit', compact('course', 'departments'));
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
            'description' => ['nullable'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]);

        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('image')) {
            $image_name = $current_timestamp . "_" . $request->image->getClientOriginalName();
            $extension = $request->image->extension();
            $request->image->storeAs('/public/courses', $image_name .".". $extension);
            $url = Storage::url("courses/". $image_name .".". $extension);
            $attributes['image']=$url;
            $course->image = $attributes['image'];
        }

        $course->department_id = $attributes['department_id'];        
        $course->title = $attributes['title'];
        $course->description = $attributes['description'];
        $course->start_date = $attributes['start_date'];
        $course->end_date = $attributes['end_date'];
        $course->save();
        return redirect(route('courses.index'))->with('success', 'Course updated successfully');
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
        return redirect(route('courses.index'))->with('success', 'Course deleted successfully');
    }

    public function indexGrades($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.gradebooks.index', compact('course'));
    }
    public function createGrades(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $user = User::findOrFail($request['user_id']);
        return view('courses.gradebooks.create', compact('course', 'user'));
    }
    public function storeGrades(Request $request, $id)
    {
        $attributes = $request->validate([
            'user_id' => ['numeric'],
            'grades' => ['numeric', 'min:0', 'max:100'],
        ]); 
        $course = Course::findOrFail($id);
        DB::table('learner_course')
        ->where('learner_id', $request->user_id)
        ->where('course_id', $course->id)
        ->update(['grades' => $request->grades]);
        return redirect(route('courses.grades.index', $course->id));
    }

    public function removeLearner(Request $request)
    {
        User::find($request['learner_id'])->learner_courses()->detach($request['course_id']);
        return redirect(route('courses.show', $request['course_id']))->with('success', 'User removed successfully');
    }

    public function addLearner($id)
    {
        $course = Course::findOrFail($id);
        $users = User::where('role', 3)->get();
        return view('courses.admin.add-learner', compact('course', 'users'));
    }
    public function storeLearner(Request $request)
    {
        $course = Course::find($request['course_id']);
        $course->learners()->sync($request['users']);
        return redirect(route('courses.show', $request['course_id']))->with('success', 'Users enrolled successfully');
    }

    public function removeInstructor(Request $request)
    {
        User::find($request['instructor_id'])->instructor_courses()->detach($request['course_id']);
        return redirect(route('courses.show', $request['course_id']))->with('success', 'User removed successfully');
    }

    public function addInstructor($id)
    {
        $course = Course::findOrFail($id);
        $users = User::where('role', 2)->get();
        return view('courses.admin.add-instructor', compact('course', 'users'));
    }
    public function storeInstructor(Request $request)
    {
        $course = Course::find($request['course_id']);
        $course->instructors()->sync($request['users']);
        return redirect(route('courses.show', $request['course_id']))->with('success', 'Users enrolled successfully');
    }
}
