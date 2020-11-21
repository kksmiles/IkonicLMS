@extends('layouts.master')

@section('title')
    Users List
@endsection

@section('body')
<div class="p-6 bg-white rounded-md shadow-md">
    <h3 class="text-gray-700 text-2xl font-semibold">Users</h3>
    <h3 class="text-blue-500 text-md mt-8"> 
        <a href="{{ route('dashboard') }}"> Dashboard </a> /  
        <a href="{{ route('users.index') }}"> Users </a>
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

<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <h2 class="text-xl text-gray-700 font-semibold capitalize">List of users</h2>
        <div class="bg-white mt-5">
            <nav class="flex flex-row">
                <form action="{{ route('users.index') }}">
                    @csrf
                    <input type="hidden" value="1" name="role">
                    <button id="AdminFilter" type="submit" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 focus:outline-none
                    {{ (session('role')==1) ? 'text-indigo-500 border-b-2 font-medium border-indigo-500' : '' }}">
                        Admins
                    </button>
                </form>
                <form action="{{ route('users.index') }}">
                    @csrf
                    <input type="hidden" value="2" name="role">
                    <button type="submit" id="instructorFilter" class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none
                    {{ (session('role')==2) ? 'text-indigo-500 border-b-2 font-medium border-indigo-500' : '' }}">
                        Instructors
                    </button>
                </form>
                <form action="{{ route('users.index') }}">
                    @csrf
                    <input type="hidden" value="3" name="role">
                    <button type="submit" id="learnerFilter" class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none
                    {{ (session('role')==3) ? 'text-indigo-500 border-b-2 font-medium border-indigo-500' : '' }}">
                        Learners
                    </button>
                </form>
            </nav>
        </div>
        <div class="mt-5 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Batch/Department</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @foreach($users as $user)
                    <tr>
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

                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">
                                @if($user->role == 2)
                                    @foreach ($user->departments as $department)
                                        @if($loop->iteration%2==0)
                                            <br>
                                        @endif
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{$department->name}}
                                        </span>
                                    @endforeach
                                    @elseif($user->role == 3)
                                        @foreach ($user->batches as $batch)
                                            @if($loop->iteration%2==0)
                                                <br>
                                            @endif                                            
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{$batch->name}}
                                            </span>
                                        @endforeach                                        
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Administrator
                                    </span>
                                @endif
                                
                            </div>
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

                        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            
                            <span x-data="{ open: false }">

                                <a class="ml-3 text-red-600 hover:text-red-900" @click="open = true">Delete</a>
                                
                                <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open">

                                    
                                    <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-6 md:mx-0" @click.away="open = false">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                Delete user
                                            </h3>

                                            <div class="mt-5">
                                                <p class="text-sm leading-5 text-gray-500">
                                                    Are you sure you want to delete {{ $user->full_name }}?
                                                </p>
                                            </div>
                                        </div>

                                        <div class="mt-5 sm:mt-6">
                                            <span class="flex flex-row-reverse w-full rounded-md shadow-sm">
                                                <button onclick="event.preventDefault(); document.getElementById('delete-form{{ $user->id }}').submit();" class="inline-flex justify-center w-2/6 px-4 py-2 text-white bg-red-600 rounded hover:bg-red-900">
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
                        </td>
                        <form id="delete-form{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                {{ $users->links() }}
            </div>
            
        </div>
    </div>
</div>
<div class="flex justify-end mt-4">
    {{-- <a href="#" class="px-6 py-3 text-blue-600 hover:text-blue-500 underline">Add to</a> --}}
    <a href="{{ route('users.create') }}">
        <button class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3">
            Create new user
        </button>
    </a>
</div>
@endsection