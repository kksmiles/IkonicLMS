@extends('layouts.master')

@section('title')
    Grades of {{ $course->title }}
@endsection

@section('body')

<div class="p-6 bg-white rounded-md shadow-md">
    <h3 class="text-gray-700 text-2xl font-semibold">Courses</h3>
    <h3 class="text-blue-500 text-md mt-8"> 
        <a href="{{ route('dashboard') }}"> Dashboard </a> / 
        @if(Auth::user()->role==1)
            <a href="{{ route('courses.index') }}"> Courses </a> /
        @endif
        <a href="{{ route('courses.show', $course->id) }}"> {{ $course->title }} </a> / 
        <a href="{{ route('courses.grades.index', $course->id) }}">Learners' grades</a> 
    </h3>
</div>


<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <h2 class="text-xl text-gray-700 font-semibold capitalize">List of learners' grades</h2>
        <div class="mt-5 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Learner</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Batch</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Assignment Grade</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Exam Grade</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @foreach($course->learners as $user) 
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ $user->getImageURL() }}" alt="" />
                                </div>
                                <div class="ml-4">
                                    <a href="{{ route('users.show', $user->id) }}">
                                        <div class="text-sm leading-5 font-medium text-gray-900">{{ $user->full_name }}</div>
                                    </a>
                                    <div class="text-sm leading-5 text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900"> 
                                @foreach ($user->batches as $batch)
                                    @if($loop->iteration%2==0)
                                        <br>
                                    @endif                                            
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{$batch->name}}
                                    </span>
                                @endforeach                                        
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 
                            <div class="text-sm leading-5 text-gray-900 truncate w-32">
                            @php
                                $assignments_full = 0;
                                $submission_full = 0;
                                foreach($course->course_material_topics as $course_material_topic)    
                                {
                                    foreach($course_material_topic->assignments as $assignment)
                                    {
                                        $assignments_full += $assignment->full_grade;
                                        if(count($assignment->submissions->where('learner_id', Auth::id())) != 0)
                                        {
                                            $submission_full += $assignment->submissions->where('learner_id', Auth::id())->first()->submission_grade;
                                        }
                                    }
                                }
                            @endphp
                             {{ $submission_full }} / {{ $assignments_full }}                                 
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 
                            <div class="text-sm leading-5 text-gray-900 truncate w-32">
                                @if($user->learner_courses->find($course->id)->pivot->grades == '')
                                    TBD
                                    @else
                                    {{ $user->learner_courses->find($course->id)->pivot->grades }} / 100   
                                @endif
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 
                            <form action="{{ route('courses.grades.create', $course->id) }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button type="submit" class="text-indigo-500">
                                    Grade
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection