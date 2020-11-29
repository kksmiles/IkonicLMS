@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('body')
<h3 class="text-gray-700 text-2xl font-semibold">Course Overview</h3>
<div class="px-auto mt-5">
    <nav class="flex flex-row">
        <form action="{{ route('dashboard') }}">
            @csrf
            <input type="hidden" value="1" name="status">
            <button id="pastFilter" type="submit" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 focus:outline-none
            {{ (session('status')==1) ? 'text-indigo-500 border-b-2 font-medium border-indigo-500' : '' }}">
                Past
            </button>
        </form>
        <form action="{{ route('dashboard') }}">
            @csrf
            <input type="hidden" value="2" name="status">
            <button type="submit" id="inProgressFilter" class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none
            {{ (session('status')==2) ? 'text-indigo-500 border-b-2 font-medium border-indigo-500' : '' }}">
                In Progress
            </button>
        </form>
        <form action="{{ route('dashboard') }}">
            @csrf
            <input type="hidden" value="3" name="status">
            <button type="submit" id="futureFilter" class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none
            {{ (session('status')==3) ? 'text-indigo-500 border-b-2 font-medium border-indigo-500' : '' }}">
                Future
            </button>
        </form>
    </nav>
</div>
<div class="grid gap-10 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 mt-10">
    @foreach($courses as $course)
    <a href="{{ route('courses.show', $course->id) }}">
        <div class="bg-white rounded-md shadow-md">
            <div class="w-full h-64 bg-cover rounded-t-md text-center overflow-hidden" style="background-image: url('{{ asset($course->getImageURL()) }}')" title="Course Image">
            </div>
            <div class="grid grid-cols-7 p-5">
                <div class="col-span-2">
                    @if(count($course->course_materials)!=0)
                        <svg width="85%" height="85%" viewbox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" fill="transparent" stroke-width="10" stroke="grey"/>
                        <circle cx="50" cy="50" r="40" fill="transparent" stroke-width="10" stroke="#00CCFF" stroke-dasharray="251.2"   stroke-dashoffset="{{ 251.2-251.2*(count(Auth::user()->learner_progress()->find([1,2]))/count($course->course_materials)) }}"/>
                            <text x="35" y="55" fill="black" font-size="18" class="font-bold">
                                {{ number_format((count(Auth::user()->learner_progress()->find([1,2]))/count($course->course_materials))*100) }}%
                            </text>
                        </svg>
                        @else
                        <svg width="85%" height="85%" viewbox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" fill="transparent" stroke-width="10" stroke="grey"/>
                            <circle cx="50" cy="50" r="40" fill="transparent" stroke-width="10" stroke="#00CCFF" stroke-dasharray="251.2"   stroke-dashoffset="251.2"/>
                            <text x="35" y="55" fill="black" font-size="18" class="font-bold">
                                0%
                            </text>
                        </svg>
                    @endif
                </div>
                <div class="col-span-5">
                    <p class="text-lg">
                        {{ $course->title }}
                    </p>
                    <div class="grid grid-cols-2 mt-5">
                        <div class="text-sm my-auto">
                            <p class="text-black text-lg font-bold leading-none">Start Date</p>
                            <p class="text-gray-600 text-base mt-5">{{ date('jS F Y', strtotime($course->start_date)) }}</p>
                        </div>
                        <div class="text-sm my-auto ml-8">
                            <p class="text-black text-lg font-bold leading-none">End Date</p>
                            <p class="text-gray-600 text-base mt-5">{{ date('jS F Y', strtotime($course->end_date)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>    
    </a>
    @endforeach
</div>

@endsection