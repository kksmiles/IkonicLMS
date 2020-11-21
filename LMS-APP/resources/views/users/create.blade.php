@extends('layouts.master')

@section('title')
    User create form
@endsection

@section('body')
<div class="p-6 bg-white rounded-md shadow-md">
    <h3 class="text-gray-700 text-2xl font-semibold">Users</h3>
    <h3 class="text-blue-500 text-md mt-8"> 
        <a href="{{ route('dashboard') }}"> Dashboard </a> /  
        <a href="{{ route('users.index') }}"> Users </a> / 
        <a href="{{ route('users.create') }}"> Add a new user </a> 
    </h3>
</div>
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-xl text-gray-700 font-semibold capitalize">Add a new user</h2>
            
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="text-gray-700" for="fullname">Full Name</label>
                        <input name="full_name" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text" required>
                    </div>

                    <div>
                        <label class="text-gray-700" for="username">Username</label>
                        <input name="username" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text" required>
                    </div>
                    
                    <div>
                        <label class="text-gray-700" for="email">Email Address</label>
                        <input name="email" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="email" required>
                    </div>

                    <div>
                        <label class="text-gray-700" for="phone">Phone Number</label>
                        <input name="phone" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text">
                    </div>

                    <div>
                        <label class="text-gray-700" for="password">Password</label>
                        <input name="password" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="password" required>
                        <label class="inline-flex items-center mt-3">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600">
                            <span class="ml-2 text-gray-700">Force Password Change</span>
                        </label>
                    </div>

                    <div>
                        <label class="text-gray-700" for="password">Confirm Password</label>
                        <input name="password_confirmation" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="password" required>
                    </div>


                    <div>
                        <label class="text-gray-700" for="image">Image</label>
                        <input name="image" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="file">
                    </div>

                    <div class="relative">
                        <label class="text-gray-700" for="role">Role</label>
                        <select class="form-input w-full mt-2 rounded-md focus:border-indigo-600" name="role" id="role" required>
                            <option value="1">Admin</option>
                            <option value="2">Instructor</option>
                            <option value="3">Learner</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 mt-8 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600" checked>
                            <span class="ml-2 text-gray-700">Send account credientials via email</span>
                        </label>
                        <br>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <a class="px-6 py-3" href="{{ url()->previous() }}">
                        Cancel                        
                    </a>
                    <button type="submit" class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3">
                        Create new user
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