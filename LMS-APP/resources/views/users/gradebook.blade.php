@extends('layouts.master')

@section('title')
    {{Auth::user()->full_name}}'s Gradebook
@endsection

@section('body')

    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <h2 class="text-xl text-gray-700 font-semibold capitalize">{{Auth::user()->full_name}}'s Gradebook</h2>
            <div class="mt-5 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Course Title</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Exam Grade</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Assignment Grade</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Overall Grade</th>
                        </tr>
                    </thead>
    
                    <tbody class="bg-white">
                        @foreach(Auth::user()->learner_courses as $course)
                        <tr>
                            
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                
                                <div class="text-sm leading-5 text-gray-900 w-64">
                                    {{ $course->title }}    
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 
                                <div class="text-sm leading-5 text-gray-900 truncate w-32">
                                    {{ $course->pivot->grades }} / 100   
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
                                    @if($assignments_full!==0)
                                        {{ ($submission_full/$assignments_full)*100 + ($course->pivot->grades/2) }} / 100
                                        @elseif($assignments_full==0)
                                            {{ ($course->pivot->grades) }} / 100
                                        @else
                                            TBD
                                    @endif
                                    
                                </div>
                            </td>

                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
@endsection

