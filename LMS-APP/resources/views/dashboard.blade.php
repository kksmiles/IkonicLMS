@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('body')
<h3 class="text-gray-700 text-2xl font-semibold">Course Overview</h3>

<div class="grid gap-10 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 mt-10">
    @foreach($courses as $course)
        <div class="bg-white rounded-md shadow-md">
            <div class="w-full h-64 bg-cover rounded-t-md text-center overflow-hidden" style="background-image: url('{{ asset($course->getImageURL()) }}')" title="Course Image">
            </div>
            <div class="grid grid-cols-7 p-5">
                <div class="col-span-2">
                    <svg width="85%" height="85%" viewbox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" fill="transparent" stroke-width="10" stroke="grey"/>
                        <circle cx="50" cy="50" r="40" fill="transparent" stroke-width="10" stroke="#00CCFF" stroke-dasharray="251.2" stroke-dashoffset="50.3"/>
                        <text x="35" y="55" fill="black" font-size="18" class="font-bold">80%</text>
                    </svg>
                </div>
                <div class="col-span-5">
                    <p class="text-lg">
                        {{ $course->title }}
                    </p>
                    <div class="grid grid-cols-2 mt-5">
                        <div class="text-sm my-auto">
                            <p class="text-black text-lg font-bold leading-none">82%</p>
                            <p class="text-gray-600 text-base mt-5">Attendance</p>
                        </div>
                        <div class="text-sm my-auto ml-8">
                            <p class="text-black text-lg font-bold leading-none">TBD</p>
                            <p class="text-gray-600 text-base mt-5">Grades</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>    
    
    @endforeach
</div>

@endsection