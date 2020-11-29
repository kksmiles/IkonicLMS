@extends('layouts.master')

@section('title')
    Site Home
@endsection

@section('body')

<h3 class="text-gray-700 text-2xl font-semibold">Site Home</h3>

<div class="flex flex-col mt-6">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <tbody class="bg-white"> 
                    <tr class="border-b">
                        <td class="px-2 py-4 whitespace-no-wrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        <span class="my-auto text-indigo-600 text-xl">
                                            Announcements
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                            
                        </td>
                        
                    </tr>
                    @foreach($site_datas as $site_data)
                    <tr>
                        <td class="px-2 py-4 whitespace-no-wrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        <i class="fas fa-file-pdf text-xl"></i> 
                                        
                                        <span class="ml-3 my-auto text-blue-600 text-base">
                                            <a href="{{ $site_data->file }}">
                                                {{ $site_data->title }}
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                            @can('update', $site_data)
                            <a href="{{ route('site-datas.edit', $site_data->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            @endcan
                            @can('delete', $site_data)
                            <span x-data="{ open: false }">

                                <a class="ml-3 text-red-600 hover:text-red-900" @click="open = true">Delete</a>
                                
                                <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open">
    
                                    
                                    <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-6 md:mx-0" @click.away="open = false">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                Delete Announcement?
                                            </h3>
    
                                            <div class="mt-5">
                                                <p class="text-sm leading-5 text-gray-500">
                                                    Are you sure you want to delete {{ $site_data->title }}?
                                                </p>
                                            </div>
                                        </div>
    
                                        <div class="mt-5 sm:mt-6">
                                            <span class="flex flex-row-reverse w-full rounded-md shadow-sm">
                                                <button onclick="event.preventDefault(); document.getElementById('delete-form{{ $site_data->id }}').submit();" class="inline-flex justify-center w-2/6 px-4 py-2 text-white bg-red-600 rounded hover:bg-red-900">
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
                            @endcan
                        </td>
                        
                        <form id="delete-form{{ $site_data->id }}" action="{{ route('site-datas.destroy', $site_data->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@can('create', $temp)
    <div class="flex justify-end mt-4">
        <a href="{{ route('site-datas.create') }}">
            <button class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3">
                Add new announcement
            </button>
        </a>
    </div>
@endcan



<h3 class="text-gray-700 text-2xl font-semibold mt-5">Available Courses</h3>
@foreach($courses as $course)
<div class="w-full lg:flex p-5 bg-white mt-5 rounded-md shadow-md">
    <div class="w-full lg:w-3/12 flex-none">
        <div class="w-full h-64 bg-cover rounded-md text-center overflow-hidden" style="background-image: url('{{ asset($course->getImageURL()) }}')" title="Course Image">
        </div>
        <hr class="block lg:hidden mt-5 mb-5">
        <div class="grid grid-cols-2 mt-8">
            <div class="text-sm my-auto text-center">
                <p class="text-black text-lg font-bold leading-none">Start Date</p>
                <p class="text-gray-600 text-sm mt-5">{{ date('jS F Y', strtotime($course->start_date)) }}</p>
            </div>
            <div class="text-sm my-auto ml-8 text-center">
                <p class="text-black text-lg font-bold leading-none">End Date</p>
                <p class="text-gray-600 text-sm mt-5">{{ date('jS F Y', strtotime($course->end_date)) }}</p>
            </div>
        </div>
    </div>
    <div class="p-1 flex flex-col justify-between leading-normal ml-0 lg:ml-8">
        <div class="mb-8 mt-3 lg:mt-0">
            <a href="{{ route('courses.show', $course->id) }}">
                <div class="text-black font-bold text-xl mb-2">{{ $course->title }}</div>            
            </a>
            <p class="text-gray-600 text-base text-justify">
                {{ $course->description }}
            </p>
        </div>
        <div class="text-black font-bold text-xl">Instructors</div>
        <div class="flex items-center">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-20 gap-y-10 mt-5">
                @foreach($course->instructors as $instructor)
                    <div class="grid grid-cols-3">
                        <a href="{{ route('users.show', $instructor->id) }}">
                            <img class="w-20 h-20 rounded-full mr-4" src="{{ $instructor->getImageURL() }}" alt="Avatar of Jonathan Reinink">
                        </a>
                    
                        <div class="text-sm col-span-2 my-auto ml-2">
                            <a href="{{ route('users.show', $instructor->id) }}">
                                <p class="text-black text-base leading-none">{{ $instructor->full_name }}</p>
                            </a>
                            <hr class="mr-5 mt-1 mb-1">
                            <a href="{{ route('departments.show', $instructor->departments->first()->id) }}">
                                <p class="text-gray-600 text-sm">{{ $instructor->departments->first()->name }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach

{{$courses->links()}}

@endsection