@extends('layouts.master')

@section('title')
    {{$user->full_name}}'s profile
@endsection

@section('body')
<h3 class="text-gray-700 text-2xl font-semibold">{{$user->full_name}}'s profile</h3>


<div class="w-full lg:flex p-5 bg-white mt-5 rounded-md shadow-md">
    <div class="w-full lg:w-3/12 flex-none">
        <div class="w-64 h-64 bg-cover rounded-full mx-auto" style="background-image: url('{{ asset($user->getImageURL()) }}')" title="Course Image">
        </div>
        <hr class="block lg:hidden mt-5 mb-5">
        <div class="text-black font-bold text-center text-xl mt-5 mb-2">{{ $user->full_name }}</div>
        <div class="text-black font-bold text-lg mt-5 mb-2">
            Email : <span class="text-black font-normal text-base">{{ $user->email }}</span>
        </div>
        <div class="text-black font-bold text-lg mt-5 mb-2">
            Username : <span class="text-black font-normal text-base">{{ $user->username }}</span>
        </div>
        <div class="text-black font-bold text-lg mt-5 mb-2">
            First Joined : <span class="text-black font-normal text-base">{{ date('jS F Y', strtotime($user->created_at)) }}</span>
        </div>
        <div class="text-black font-bold text-lg mt-5 mb-2">
            @if($user->role == 3)
                Batch :  
                @foreach($user->batches as $batch)
                    <span class="text-black font-normal text-base">{{ $batch->name }}</span>
                @endforeach
                    @elseif($user->role == 2)
                        Department :  
                        @foreach($user->departments as $department)
                            <span class="text-black font-normal text-base">{{ $department->name }}</span> 
                        @endforeach
                    @else
                        Administrator
            @endif
        </div>
    </div>
    <div class="p-1 flex flex-col justify-between leading-normal ml-0 lg:ml-8">
        <div class="mb-8 mt-3 lg:mt-0">
            <div class="text-black font-bold text-xl mb-2">Course Details</div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-20 gap-y-10 mt-5">
                @if($user->role==3)
                    @foreach($user->learner_courses as $course)
                        <div class="grid grid-cols-4">
                            <a href="{{ route('courses.show', $course->id) }}">
                                <img class="w-20 h-20 rounded-md mr-4" src="{{ $course->getImageURL() }}">
                            </a>
                        
                            <div class="text-sm col-span-3 my-auto">
                                <a href="{{ route('courses.show', $course->id) }}">
                                    <p class="text-black text-base leading-none">{{ $course->title }}</p>
                                </a>
                                <hr class="mr-5 mt-1 mb-1">
                                <a href="{{ route('departments.show', $course->department->id) }}">
                                    <p class="text-gray-600 text-sm">{{ $course->department->name }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @elseif($user->role==2)
                    @foreach($user->instructor_courses as $course)
                    <div class="grid grid-cols-4">
                        <a href="{{ route('courses.show', $course->id) }}">
                            <img class="w-20 h-20 rounded-md mr-4" src="{{ $course->getImageURL() }}">
                        </a>
                    
                        <div class="text-sm col-span-3 my-auto">
                            <a href="{{ route('courses.show', $course->id) }}">
                                <p class="text-black text-base leading-none">{{ $course->title }}</p>
                            </a>
                            <hr class="mr-5 mt-1 mb-1">
                            <a href="{{ route('departments.show', $course->department->id) }}">
                                <p class="text-gray-600 text-sm">{{ $course->department->name }}</p>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @endif

            </div>
        </div>        
    </div>
</div>

@endsection