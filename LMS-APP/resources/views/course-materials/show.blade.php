@extends('layouts.master')

@section('title')
    {{ $course_material->title }}
@endsection

@section('body')

<div class="p-6 bg-white rounded-md shadow-md">
    <h3 class="text-gray-700 text-2xl font-semibold">Courses</h3>
    <h3 class="text-blue-500 text-md mt-8"> 
        <a href="{{ route('dashboard') }}"> Dashboard </a> / 
        @if(Auth::user()->role==1)
            <a href="{{ route('courses.index') }}"> Courses </a> /
        @endif
        <a href="{{ route('courses.show', $course_material->course_material_topic->course->id) }}"> {{ $course_material->course_material_topic->course->title }} </a> /
        <a href="#">{{ $course_material->title }}</a>
    </h3>
</div>

<div class="w-full p-6 bg-white mt-5 rounded-md shadow-md">
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-5">
        <div class="">
            <h2 class="text-lg lg:text-2xl">
                {{ $course_material->title }}
            </h2>
            <p class="text-justify text-base mt-5">
                {{ $course_material->description }}
            </p> 
            @if($course_material->file_type == "pdf" 
            || $course_material->file_type == "ppt" 
            || $course_material->file_type == "zip"
            )
                <iframe class="w-full h-full mt-5" src="{{ $course_material->course_material_file }}">
                    This browser does not support PDFs. Please download the PDF to view it: Download PDF
                </iframe>
                @elseif($course_material->file_type == "3GP" 
                || $course_material->file_type == "mp4" 
                || $course_material->file_type == "OGG"
                || $course_material->file_type == "mkv"
                )
                    <video class="w-full h-auto mt-5" controls>
                        <source src="{{ $course_material->course_material_file }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                <img class="w-full mt-5 p-10" src="{{ $course_material->getFileURL() }}">
                <p class="text-center text-xl">No file</p>
            @endif
            
        </div>
        <div class="bg-gray-100 px-5 py-2">
            <h2 class="text-lg lg:text-2xl">
                Discussion Comments
            </h2>
            <div class="py-3 h-64 mt-2 overflow-y-auto">
                @foreach($course_material->comments as $comment)
                    <div class="px-3 pt-1 mt-3 flex">
                        <img
                        src="{{ $comment->user->getImageURL() }}"
                        class=" w-12 h-12 rounded-full"
                        alt="dp"
                        />
                        <div class="flex flex-wrap ml-4 pb-4 w-full">
                            <div class="inline-flex justify-between w-full font-bold">
                                {{ $comment->user->full_name }}
                                @can('delete', $comment)
                                <span x-data="{ open: false }">

                                    <a class="inline-flex text-red-600 hover:text-red-900 text-sm" @click="open = true">Delete</a>
                                
                                    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open">
                                
                                        
                                        <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-6 md:mx-0" @click.away="open = false">
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                    Delete comment
                                                </h3>
                                
                                                <div class="mt-5">
                                                    <p class="text-sm leading-5 text-gray-500">
                                                        Are you sure you want to delete your comment?
                                                    </p>
                                                </div>
                                            </div>
                                
                                            <div class="mt-5 sm:mt-6">
                                                <span class="flex flex-row-reverse w-full rounded-md shadow-sm">
                                                    <button onclick="event.preventDefault(); document.getElementById('delete-form{{ $comment->id }}').submit();" class="inline-flex justify-center w-2/6 px-4 py-2 text-white bg-red-600 rounded hover:bg-red-900">
                                                        Delete
                                                    </button>
                                                    <button @click="open = false" class="mr-3 inline-flex justify-center w-2/6 px-4 py-2 text-gray-700">
                                                        Cancel
                                                    </button>
                                                </span>
                                            </div>
                                
                                        </div>
                                    </div>
                                </span>
                                <form id="delete-form{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endcan
                            </div>
                            <div class="inline-flex w-full text-sm mt-2 text-gray-500 text-justify">{{ $comment->comment }}</div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <div class="w-full mt-3">
                    <input type="hidden" name="course_material_id" value="{{ $course_material->id }}">
                    <input name="comment" class="form-input w-10/12 mt-2 rounded-md focus:border-indigo-600" type="text" required>
                    <button class="ml-3 text-indigo-600 hover:text-indigo-900" type="submit">Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>
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

@endsection


