@extends('layouts.master')

@section('title')
    Calendar
@endsection

@section('body')
    <h3 class="text-gray-700 text-2xl font-semibold mt-5">Calendar</h3>
    <form action="{{ route('calendar') }}" method="GET">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
                <label class="text-gray-700" for="fullname">Date : </label>
            <input name="date" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="date" value="{{ $date->toDateString() }}">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
                <button class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3" type="submit">Refresh</button>
            </div>
        </div>
    </form>
    <br>    
    <div class="w-full p-5 bg-white mt-5 rounded-md shadow-md">
        <h2 class="text-xl font-bold">
            {{ date('l jS F', strtotime($date)) }}
        </h2>
        @foreach($assignments as $assignment)
        <div class="bg-gray-200 p-5 border-l-4 border-red-700 mt-3">
            <h3 class="text-lg">
            {{$assignment->title}} from 
            <a class="text-blue-500" href="{{ route('courses.show', $assignment->course_material_topic->course->id) }}">
                {{ $assignment->course_material_topic->course->title }}
            </a>  is due today.
            </h3> 
        </div>
        @endforeach
        @foreach($start_courses as $start_course)
        <div class="bg-gray-200 p-5 border-l-4 border-yellow-700 mt-3">
            <h3 class="text-lg">
                <a class="text-blue-500" href="{{ route('courses.show', $start_course->id) }}">
                    {{$start_course->title}}
                </a> 
                 is starting today.
            </h3> 
        </div>
        @endforeach
        @foreach($end_courses as $end_course)
        <div class="bg-gray-200 p-5 border-l-4 border-indigo-700 mt-3">
            <h3 class="text-lg">
                <a class="text-blue-500" href="{{ route('courses.show', $end_course->id) }}">
                    {{$end_course->title}}
                </a> 
                 is ending today.
            </h3> 
        </div>
        @endforeach
    </div>
@endsection