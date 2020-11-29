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
        <a href="{{ route('courses.grades.index', $course->id) }}">Learners' grades</a> / Grade
    </h3>
</div>

<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-xl text-gray-700 font-semibold capitalize">Grade</h2>
            
            <form action="{{ route('courses.grades.store', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    
                    <div>
                        <label class="text-gray-700" for="grades">Grades</label> <br>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input name="grades" value="{{ $user->learner_courses->find($course->id)->pivot->grades }}" min="0" max="100" class="form-input w-1/5 mt-2 rounded-md focus:border-indigo-600" type="number" required> 
                        / 100
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
@if ($errors->any())
<div class="mt-5">
    <div class="inline-flex max-w-sm w-full bg-white shadow-md rounded-lg overflow-hidden ml-3">
        <div class="flex justify-center items-center w-12 bg-red-500">
            <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"/>
            </svg>
        </div>
        
        <div class="-mx-3 py-2 px-4">
            <div class="mx-3">
                <span class="text-red-500 font-semibold">Error</span>
                @foreach ($errors->all() as $error)
                    <p class="text-gray-600 text-sm">{{ $error }}</p>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endif
@endsection


