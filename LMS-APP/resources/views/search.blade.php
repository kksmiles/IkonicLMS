@extends('layouts.master')

@section('title')
    Search Results
@endsection

@section('body')
    <h3 class="text-gray-700 text-2xl font-semibold mt-5">Users</h3>
    <div class="grid gap-10 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 p-6 bg-white rounded-md shadow-md overflow-y-auto">
        @foreach($users as $user)
            <div class="pb-3 bg-white rounded-md shadow-md">
                <img src="{{ $user->getImageURL() }}" class="w-32 h-32 rounded-full mx-auto">
                <p class="text-center text-base font-bold mt-5">{{ $user->full_name }}</p>
                <p class="text-center text-sm text-gray-500 mt-5">
                    @if($user->role==1)
                        Admin
                        @elseif($user->role==2)
                            Instructor
                        @elseif($user->role==3)
                            Learner
                    @endif
                </p>
            </div>
        @endforeach
    </div>

    <h3 class="text-gray-700 text-2xl font-semibold mt-5">Courses</h3>
    @foreach($courses as $course)
    <div class="w-full lg:flex p-5 bg-white mt-5 rounded-md shadow-md">
        <div class="w-full lg:w-3/12 flex-none">
            <div class="w-full h-48 bg-cover rounded-md text-center overflow-hidden" style="background-image: url('{{ asset($course->getImageURL()) }}')" title="Course Image">
            </div>
        </div>
        <div class="p-1 flex flex-col justify-between leading-normal ml-0 lg:ml-8">
            <div class="mb-8 mt-3 lg:mt-0">
                <a href="{{ route('courses.show', $course->id) }}">
                    <div class="text-black font-bold text-xl mb-2">{{ $course->title }}</div>            
                </a>
                <p class="text-gray-600 text-base text-justify hidden lg:block xl:block">
                    {{ $course->description }}
                </p>
            </div>            
        </div>
    </div>
    @endforeach
        
@endsection