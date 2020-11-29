@extends('layouts.master')

@section('title')
    {{ $assignment->title }}
@endsection

@section('body')

@if(session()->has('success'))
<div class="mt-5 inline-flex max-w-sm w-full bg-white shadow-md rounded-lg overflow-hidden ml-3">
    <div class="flex justify-center items-center w-12 bg-green-500">
        <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"/>
        </svg>
    </div>
    
    <div class="-mx-3 py-2 px-4">
        <div class="mx-3">
            <span class="text-green-500 font-semibold">Success</span>
            <p class="text-gray-600 text-sm">{{ session()->get('success') }}</p>
        </div>
    </div>
</div>
@endif


<div class="p-6 bg-white rounded-md shadow-md">
    <h3 class="text-gray-700 text-2xl font-semibold">Courses</h3>
    <h3 class="text-blue-500 text-md mt-8"> 
        <a href="{{ route('dashboard') }}"> Dashboard </a> / 
        <a href="{{ route('courses.show', $assignment->course_material_topic->course->id) }}"> {{ $assignment->course_material_topic->course->title }} </a> /
        <a href="#">{{ $assignment->title }}</a>
    </h3>
</div>


@if($assignment->isOverDue())
<div class="mt-5">
    <div class="inline-flex max-w-sm w-full bg-white shadow-md rounded-lg overflow-hidden ml-3">
        <div class="flex justify-center items-center w-12 bg-red-500">
            <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"/>
            </svg>
        </div>
        
        <div class="-mx-3 py-2 px-4">
            <div class="mx-3">
                <span class="text-red-500 font-semibold">Overdue</span>
                
                <p class="text-gray-600 text-sm">It is already after the due date</p>
                
            </div>
        </div>
    </div>
</div>    
@endif

<div class="w-full p-6 bg-white mt-5 rounded-md shadow-md">
    <h2 class="text-lg lg:text-2xl">
        {{ $assignment->title }}
    </h2>
    <div class="bg-gray-200 p-5 border-l-4 border-indigo-700 mt-3">
        <h3 class="text-lg">
            {{ $assignment->description }}
        </h3> 
        <p class="mt-5"></p>
        <a href="{{ $assignment->getFileURL() }}">
            <i class="far fa-file-pdf text-xl"></i> 
            <span class="ml-3 text-base text-blue-500"> Download associated file</span>
        </a>
    </div>

    @if(Auth::user()->role == 3)
        <div class="mt-6">
            <h2 class="text-lg lg:text-2xl"> Submission Status </h2>
            <div class="bg-white shadow rounded-md overflow-hidden my-6 border">
                <table class="text-left w-full border-collapse">
                    <tbody>
                        <tr class="hover:bg-gray-200">
                            <td class="py-4 px-6 border-b border-r text-gray-700 text-lg">Submission Status</td>
                            <td class="py-4 px-6 border-b text-gray-700">
                                @if(count($assignment->submissions->where('learner_id', Auth::id()))==0)
                                    No submission    
                                    @else
                                    Submitted for grading
                                @endif
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-200">
                            <td class="py-4 px-6 border-b border-r text-gray-700 text-lg">Grading Status</td>
                            <td class="py-4 px-6 border-b text-gray-700">
                                @if(count($assignment->submissions->where('learner_id', Auth::id()))==0)
                                    Not graded    
                                    @else
                                    @if($assignment->submissions->where('learner_id', Auth::id())->first()->submission_grade=='')
                                        Not graded    
                                        @else
                                        {{ $assignment->submissions->where('learner_id', Auth::id())->first()->submission_grade }} / 
                                        {{ $assignment->full_grade }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-200">
                            <td class="py-4 px-6 border-b border-r text-gray-700 text-lg">Due Date</td>
                            <td class="py-4 px-6 border-b text-gray-700">
                                {{ date('jS F Y', strtotime($assignment->due_date)) }}
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-200">
                            <td class="py-4 px-6 border-b border-r text-gray-700 text-lg">Last Modified</td>
                            <td class="py-4 px-6 border-b text-gray-700">
                                @if(count($assignment->submissions->where('learner_id', Auth::id()))==0)
                                    No submission    
                                    @else
                                    {{ date(' h:i A jS F Y', strtotime($assignment->submissions->where('learner_id', Auth::id())->first()->updated_at)) }}
                                @endif
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-200">
                            <td class="py-4 px-6 border-b border-r text-gray-700 text-lg">Submission</td>
                            <td class="py-4 px-6 border-b text-gray-700">
                                @if(count($assignment->submissions->where('learner_id', Auth::id()))==0)
                                    No submission    
                                    @else
                                    <i class="far fa-file-pdf text-xl"></i> 
                                    <a href="{{ $assignment->submissions->where('learner_id', Auth::id())->first()->getFileURL() }}" class="text-blue-500 ml-3">
                                         Download submitted file
                                    </a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if(!$assignment->isOverDue())
        <div class="flex justify-end mt-4">
            @if(count($assignment->submissions->where('learner_id', Auth::id()))==0)
            <form action="{{ route('learner-submissions.create') }}">
                @csrf
                <input type="hidden" value="{{ $assignment->id }}" name="assignment_id">
                <button type="submit" class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3">
                    Add new Submission
                </button>
            </form>
            @else
                <a href="{{ route('learner-submissions.edit', $assignment->submissions->where('learner_id', Auth::id())->first()->id) }}">
                    <button class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3">
                        Edit Submission
                    </button>
                </a>
            @endif
        </div>
        @endif

        <div class="mt-6">
            <h2 class="text-lg lg:text-2xl"> Feedback </h2>
            <div class="bg-white shadow rounded-md overflow-hidden my-6 border">
                <table class="text-left w-full border-collapse">
                    <tbody>
                        <tr class="hover:bg-gray-200">
                            <td class="py-4 px-6 border-b border-r text-gray-700 text-lg">Grade</td>
                            <td class="py-4 px-6 border-b text-gray-700">
                                @if(count($assignment->submissions->where('learner_id', Auth::id()))==0)
                                    Not graded    
                                    @else
                                    @if($assignment->submissions->where('learner_id', Auth::id())->first()->submission_grade=='')
                                        Not graded    
                                        @else
                                        {{ $assignment->submissions->where('learner_id', Auth::id())->first()->submission_grade }} / 
                                        {{ $assignment->full_grade }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-200">
                            <td class="py-4 px-6 border-b border-r text-gray-700 text-lg">Graded On</td>
                            <td class="py-4 px-6 border-b text-gray-700">
                                @if(count($assignment->submissions->where('learner_id', Auth::id()))==0)
                                    Not graded    
                                    @else
                                    @if($assignment->submissions->where('learner_id', Auth::id())->first()->submission_grade=='')
                                        Not graded    
                                        @else
                                        {{ date(' h:i A jS F Y', strtotime($assignment->submissions->where('learner_id', Auth::id())->first()->updated_at)) }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-200">
                            <td class="py-4 px-6 border-b border-r text-gray-700 text-lg">Graded By</td>
                            <td class="py-4 px-6 border-b text-gray-700">
                                @if(count($assignment->submissions->where('learner_id', Auth::id()))==0)
                                    Not graded    
                                    @else
                                    @if($assignment->submissions->where('learner_id', Auth::id())->first()->submission_grade=='')
                                        Not graded    
                                        @else
                                        {{ $assignment->submissions->where('learner_id', Auth::id())->first()->grader->full_name }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-200">
                            <td class="py-4 px-6 border-b border-r text-gray-700 text-lg">Feedback</td>
                            <td class="py-4 px-6 border-b text-gray-700">
                                @if(count($assignment->submissions->where('learner_id', Auth::id()))==0)
                                    No feedback    
                                    @else
                                    @if($assignment->submissions->where('learner_id', Auth::id())->first()->feedback=='')
                                        No feedback  
                                        @else
                                        {{ $assignment->submissions->where('learner_id', Auth::id())->first()->feedback }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
    <div class="mt-6">
        <h2 class="text-lg lg:text-2xl"> Summary of learners' submission </h2>
        <div class="mt-5 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Learner</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Submitted File</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Submitted On</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Graded On</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Grades</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @foreach($assignment->submissions as $submission)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{ $submission->learner->full_name }}
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            
                            <div class="text-sm leading-5 text-gray-900 truncate w-64">
                                <a href="{{ $submission->getFileURL() }}">
                                    <i class="far fa-file-pdf text-xl"></i> 
                                    <span class="ml-3 text-base text-blue-500"> Download file</span>
                                </a>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">
                                {{ date(' h:i A jS F Y', 
                                strtotime($submission->created_at)) }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">
                                {{ date(' h:i A jS F Y', 
                                strtotime($submission->updated_at)) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">
                                {{ $submission->submission_grade }} / {{ $assignment->full_grade }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-blue-500 underline">
                                <form action="{{ route('submission.feedback.create') }}">
                                @csrf
                                    <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                                    <button type="submit">Give Feedback</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div>
    @endif
</div>
@endsection


