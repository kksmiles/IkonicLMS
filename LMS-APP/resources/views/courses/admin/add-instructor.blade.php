@extends('layouts.master')

@section('title')
    {{ $course->title }}
@endsection

@section('body')
<div class="p-6 bg-white rounded-md shadow-md">
    <h3 class="text-gray-700 text-2xl font-semibold">Courses</h3>
    <h3 class="text-blue-500 text-md mt-8"> 
        <a href="{{ route('dashboard') }}"> Dashboard </a> / 
        @if(Auth::user()->role==1)
            <a href="{{ route('courses.index') }}"> courses </a> /
        @endif
        <a href="{{ route('courses.show', $course->id) }}"> {{ $course->title }} </a> /
        <a href="#">Enrol instructors</a>
    </h3>
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

<form action="{{ route('course-instructor.store', $course->id) }}" method="POST">
    @csrf
    <input name="course_id" type="hidden" value="{{ $course->id }}">
<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <h2 class="text-xl text-gray-700 font-semibold capitalize">List of instructors</h2>
        <div class="mt-5 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-1 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-1 py-4 whitespace-no-wrap border-b border-gray-200">
                            <input type="checkbox" name="users[]" value="{{ $user->id }}" class="ml-3 form-checkbox h-5 w-5 text-indigo-600 border-gray-700" {{ in_array($user->id, $course->instructors->pluck('id')->toArray()) ? 'checked' : '' }}>
                        </td>
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
                            <div class="text-sm leading-5 text-gray-900">{{ $user->username }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                            @switch($user->role)
                                @case(1)
                                    Admin
                                    @break
                                @case(2)
                                Instructor
                                    @break
                                @case(3)
                                    Learner
                                    @break
                                @default
                                    Guest                                    
                            @endswitch
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>          
        </div>
    </div>
</div>

<div class="flex justify-end mt-4">
    <a class="px-6 py-3" href="{{ url()->previous() }}">
        Cancel                        
    </a>
    <button type="submit" class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3">
        Add
    </button>
</div>

</form>
@endsection