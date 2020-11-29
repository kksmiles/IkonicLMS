<?php

namespace App\Http\Controllers;

use App\Models\LearnerSubmission;
use Carbon\Carbon;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class LearnerSubmissionController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');   
        $this->authorizeResource(LearnerSubmission::class);
    }
    public function create(Request $request)
    {
        $assignment = Assignment::findOrFail($request['assignment_id']);
        return view('learner-submissions.create', compact('assignment'));
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
            'assignment_id' => ['numeric'],
            'submission_file' => ['mimes:pdf,zip', 'max:10240']
        ]);
        $attributes['learner_id'] = Auth::id();
        $attributes['graded_by'] = Auth::id();

        $current_timestamp = Carbon::now()->timestamp;

        $file_name = $current_timestamp . "_" . $request->submission_file->getClientOriginalName();
        $extension = $request->submission_file->extension();
        $request->submission_file->storeAs('/public/assignments/submissions', $file_name .".". $extension);
        $url = Storage::url("assignments/submissions/". $file_name .".". $extension);
        $attributes['submission_file']=$url;        

        LearnerSubmission::create($attributes);
        return redirect(route('assignments.show', $request['assignment_id']))->with('success', 'File submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LearnerSubmission  $learnerSubmission
     * @return \Illuminate\Http\Response
     */
    public function show(LearnerSubmission $learnerSubmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LearnerSubmission  $learnerSubmission
     * @return \Illuminate\Http\Response
     */
    public function edit(LearnerSubmission $learnerSubmission)
    {
        $assignment = Assignment::findOrFail($learnerSubmission->assignment_id);
        return view('learner-submissions.edit', compact('assignment', 'learnerSubmission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LearnerSubmission  $learnerSubmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LearnerSubmission $learnerSubmission)
    {
        $attributes = $request->validate([
            'assignment_id' => ['numeric'],
            'submission_file' => ['mimes:pdf,zip', 'max:10240']
        ]);
        $current_timestamp = Carbon::now()->timestamp;

        $file_name = $current_timestamp . "_" . $request->submission_file->getClientOriginalName();
        $extension = $request->submission_file->extension();
        $request->submission_file->storeAs('/public/assignments/submissions', $file_name .".". $extension);
        $url = Storage::url("assignments/submissions/". $file_name .".". $extension);
        $attributes['submission_file']=$url;        

        $learnerSubmission->submission_file = $url;
        $learnerSubmission->save();
        return redirect(route('assignments.show', $request['assignment_id']))->with('success', 'File updated successfully');
    }
    public function createFeedback(Request $request)
    {
        $submission = LearnerSubmission::findOrFail($request['submission_id']);
        $assignment = Assignment::findOrFail($submission->assignment_id);
        return view('learner-submissions.feedback', compact('submission', 'assignment'));
    }

    public function storeFeedback(Request $request)
    {
        $submission = LearnerSubmission::findOrFail($request['submission_id']);
        $assignment = Assignment::findOrFail($submission->assignment_id);
        $attributes = $request->validate([
            'submission_id' => ['numeric'],
            'submission_grade' => ['numeric', 'required', 'max:'.$assignment->full_grade, 'min:0'],
            'feedback' => ['string', 'nullable']
        ]);
        $submission->submission_grade = $attributes['submission_grade'];
        $submission->graded_by = Auth::id();
        $submission->feedback = $attributes['feedback'];
        $submission->save();
        return redirect(route('assignments.show', $submission->assignment_id))->with('success', 'Graded successfully');
    }
}
