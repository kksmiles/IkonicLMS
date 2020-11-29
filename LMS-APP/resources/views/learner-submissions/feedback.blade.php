@extends('layouts.master')

@section('title')
    {{ $submission->learner->full_name }}'s submission
@endsection

@section('body')

<div class="p-6 bg-white rounded-md shadow-md">
    <h3 class="text-gray-700 text-2xl font-semibold">Courses</h3>
    <h3 class="text-blue-500 text-md mt-8"> 
        <a href="{{ route('dashboard') }}"> Dashboard </a> / 
        <a href="{{ route('courses.show', $assignment->course_material_topic->course->id) }}"> {{ $assignment->course_material_topic->course->title }} </a> /
        <a href="{{ route('assignments.show', $assignment->id) }}">{{ $assignment->title }} </a> / 
        <a href="#"> {{ $submission->learner->full_name }}'s submission </a>
    </h3>
</div>

<div class="w-full p-6 bg-white mt-5 rounded-md shadow-md">
    <h2 class="text-lg lg:text-2xl">
        {{ $assignment->title }}
    </h2>
    <div class="bg-gray-200 p-5 border-l-4 border-indigo-700 mt-3">
        <h3 class="text-lg">
            {{ $assignment->description }}
        </h3> 
        <p class="mt-5">
            <a href="{{ $assignment->getFileURL() }}">
                <i class="far fa-file-pdf text-xl"></i> 
                <span class="ml-3 text-base text-blue-500"> Download associated file</span>
            </a>
        </p>
    </div>
    <div class="bg-gray-200 p-5 border-l-4 border-indigo-700 mt-3">
        <h3 class="text-lg">
            {{ $submission->learner->full_name }}'s submission
        </h3> 
        <p class="mt-5">
            <a href="{{ $submission->getFileURL() }}">
                <i class="far fa-file-pdf text-xl"></i> 
                <span class="ml-3 text-base text-blue-500"> Download file</span>
            </a>      
        </p>
    </div>
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-xl text-gray-700 font-semibold capitalize">Give Feedback</h2>
                
                <form action="{{ route('submission.feedback.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                        <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                        <div>
                            <label class="text-gray-700" for="submission_grade">Grade</label> <br>
                            <input name="submission_grade" value="{{ $submission->submission_grade }}" min="0" max="{{ $assignment->full_grade }}" class="form-input w-1/5 mt-2 rounded-md focus:border-indigo-600" type="number" required> 
                            / {{ $assignment->full_grade }}
                        </div>

                        <div>
                            <label class="text-gray-700" for="batchname">Feedback</label>
                            <textarea name="feedback" id="" rows="5" class="form-input w-full mt-2 rounded-md focus:border-indigo-600">{{ $submission->feedback }}</textarea>
                        </div>               
                    </div>
    
                    <div class="flex justify-end mt-4">
                        <a class="px-6 py-3" href="{{ url()->previous() }}">
                            Cancel                        
                        </a>
                        <button type="submit" class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>

@endsection