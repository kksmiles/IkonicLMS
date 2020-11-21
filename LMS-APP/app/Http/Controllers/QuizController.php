<?php

namespace App\Http\Controllers;

use App\Models\CourseMaterialTopic;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
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
        return view('quizzes.create', compact('course_material_topics', 'current_course_material_topic'));
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable','max:255'],
            'due_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'attempts_allowed' => ['required', 'numeric'],
            'pass_percentage' => ['required', 'numeric'],
            'grading_method' => ['required', Rule::in(['Highest Attempt', 'First Attempt', 'Last Attempt'])],
        ]);
        Quiz::create($attributes);
        return redirect(route('quizzes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $attributes = $request->validate([
            'course_id' => ['numeric'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable','max:255'],
            'due_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'attempts_allowed' => ['required', 'numeric'],
            'pass_percentage' => ['required', 'numeric'],
            'grading_method' => ['required', Rule::in(['Highest Attempt', 'First Attempt', 'Last Attempt'])],
        ]);
        $quiz->course_id = $attributes['course_id'];
        $quiz->title = $attributes['title'];
        $quiz->description = $attributes['description'];
        $quiz->due_date = $attributes['due_date'];
        $quiz->attempts_allowed = $attributes['attempts_allowed'];
        $quiz->pass_percentage = $attributes['pass_percentage'];
        $quiz->grading_method = $attributes['grading_method'];
        $quiz->save();
        return redirect(route('quizzes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect(route('quizzes.index'));
    }
}
