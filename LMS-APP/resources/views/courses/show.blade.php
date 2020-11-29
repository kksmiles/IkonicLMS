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
            <a href="{{ route('courses.index') }}"> Courses </a> /
        @endif
        <a href="{{ route('courses.show', $course->id) }}"> {{ $course->title }} </a>
    </h3>
</div>

<div class="w-full lg:flex p-5 bg-white mt-5 rounded-md shadow-md">
    <div class="w-full lg:w-3/12 flex-none">
        <div class="w-full h-64 bg-cover rounded-md text-center overflow-hidden" style="background-image: url('{{ asset($course->getImageURL()) }}')" title="Course Image">
        </div>
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
        <hr class="block lg:hidden mt-5 mb-5">
    </div>
    <div class="p-1 flex flex-col justify-between leading-normal ml-0 lg:ml-8">
        <div class="mb-8 mt-3 lg:mt-0">
            <div class="text-black font-bold text-xl mb-2">{{ $course->title }}</div>
            <p class="text-gray-600 text-base text-justify">
                {{ $course->description }}
            </p>
        </div>
        <div class="text-black font-bold text-xl">
            Instructors

        </div>
        
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
                @if(Auth::user()->role == 1)
            
                <a href="{{ route('course-instructor.add', $course->id) }}">
                    <button class="px-6 py-3 bg-indigo-600 rounded-md text-lg text-white font-medium tracking-wide hover:bg-indigo-500 ml-3">
                        Assign Instructor
                    </button>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->role == 1)
    @include('courses.admin.show')
    @else
    <div class="flex flex-col mt-6">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <tbody class="bg-white">
                        <tr>
                            @if(Auth::user()->role==2)
                            <td class="px-2 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            <a href="{{ route('courses.grades.index', $course->id) }}">
                                                <i class="fas fa-book text-xl"></i> 
                                                <span class="ml-3 my-auto text-blue-600 text-base">
                                                    Grades
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @endif
    
                            
                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                            </td>
                        </tr>
                        @foreach($course->course_material_topics as $course_material_topic)
                            
                            <tr class="border-t">
                                <td class="px-2 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                <span class="my-auto text-indigo-600 text-xl">
                                                    {{ $course_material_topic->title }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @if(Auth::user()->role == 2 && !(count($course_material_topic->course->instructors->where('id', Auth::id())) == 0))
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <a href="{{ route('course-material-topics.edit', $course_material_topic->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                    </td>
                                    @else
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium"> </td>
                                @endif
                            </tr>
                            @foreach($course_material_topic->course_materials as $course_material)
                                <tr>
                                    <td class="px-2 py-4 whitespace-no-wrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                    @if($course_material->file_type == "3GP" 
                                                    || $course_material->file_type == "mp4" 
                                                    || $course_material->file_type == "OGG"
                                                    || $course_material->file_type == "mkv"
                                                    )
                                                        <i class="fas fa-file-video text-xl"></i> 
                                                        @else
                                                            <i class="far fa-file-pdf text-xl"></i>
                                                    @endif
                                                    <span class="ml-3 my-auto text-blue-600 text-base">
                                                        <a href="{{ route('course-materials.show', $course_material->id) }}">
                                                            {{ $course_material->title }}
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @if(Auth::user()->role == 2 && !(count($course_material_topic->course->instructors->where('id', Auth::id())) == 0))
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                            <a href="{{ route('course-materials.edit', $course_material->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                                <span x-data="{ open: false }">
                                                <a class="ml-3 text-red-600 hover:text-red-900" @click="open = true">Delete</a>
                                                <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open">
                                                    <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-6 md:mx-0" @click.away="open = false">
                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                                Delete material
                                                            </h3>
                
                                                            <div class="mt-5">
                                                                <p class="text-sm leading-5 text-gray-500">
                                                                    Are you sure you want to delete {{ $course_material->title }}?
                                                                </p>
                                                            </div>
                                                        </div>
                
                                                        <div class="mt-5 sm:mt-6">
                                                            <span class="flex flex-row-reverse w-full rounded-md shadow-sm">
                                                                <button onclick="event.preventDefault(); document.getElementById('delete-form{{ $course_material->title }}').submit();" class="inline-flex justify-center w-2/6 px-4 py-2 text-white bg-red-600 rounded hover:bg-red-900">
                                                                    Delete
                                                                </button>
                                                                <button @click="open = false" class="mr-3 inline-flex justify-center w-2/6 px-4 py-2 text-gray-700">
                                                                    Cancel
                                                                </button>
                                                            </span>
                                                        </div>
                                                        <form id="delete-form{{ $course_material->title }}" action="{{ route('course-materials.destroy', $course_material->id) }}" method="POST" class="hidden">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                
                                                    </div>
                                                </div>
                                            </span>
        
                                            @if(Auth::user()->learner_progress()->where([
                                                    ['learner_id', Auth::id()],
                                                    ['course_material_id', $course_material->id]
                                                ])->exists())
                                                <input type="checkbox" class="ml-3 form-checkbox h-5 w-5 text-indigo-600 border-gray-700" {{ ($course_material->learner_progress()->where('learner_id', Auth::id())->first()->pivot->completed) ? 'checked' : '' }} onclick="document.getElementById('unCheckForm{{ $course_material->id }}').submit()">
                                                
                                                <form action="/course-materials/{{ $course_material->id }}/uncheck" id="unCheckForm{{ $course_material->id }}" class="hidden">
                                                
                                                </form>
                                                @else
                                                    <input type="checkbox" class="ml-3 form-checkbox h-5 w-5 text-indigo-600 border-gray-700" onclick="document.getElementById('checkForm{{ $course_material->id }}').submit()">
                                                    <form action="/course-materials/{{ $course_material->id }}/check" id="checkForm{{ $course_material->id }}" class="hidden">
        
                                                    </form>
        
                                            @endif
                                        </td>

                                        @else
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                            @if(Auth::user()->learner_progress()->where([
                                                        ['learner_id', Auth::id()],
                                                        ['course_material_id', $course_material->id]
                                                    ])->exists())
                                                    <input type="checkbox" class="ml-3 form-checkbox h-5 w-5 text-indigo-600 border-gray-700" {{ ($course_material->learner_progress()->where('learner_id', Auth::id())->first()->pivot->completed) ? 'checked' : '' }} onclick="document.getElementById('unCheckForm{{ $course_material->id }}').submit()">
                                                    
                                                    <form action="/course-materials/{{ $course_material->id }}/uncheck" id="unCheckForm{{ $course_material->id }}" class="hidden">
                                                    
                                                    </form>
                                                    @else
                                                        <input type="checkbox" class="ml-3 form-checkbox h-5 w-5 text-indigo-600 border-gray-700" onclick="document.getElementById('checkForm{{ $course_material->id }}').submit()">
                                                        <form action="/course-materials/{{ $course_material->id }}/check" id="checkForm{{ $course_material->id }}" class="hidden">
            
                                                        </form>
            
                                            @endif
                                        </td>
                                    @endif
                                    
                                </tr>
                            @endforeach
                            @foreach($course_material_topic->assignments as $assignment)
                                <tr>
                                    <td class="px-2 py-4 whitespace-no-wrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                    <i class="far fa-file-archive text-xl"></i>
                                                    <span class="ml-3 my-auto text-blue-600 text-base">
                                                        <a href="{{ route('assignments.show', $assignment->id) }}">
                                                            {{ $assignment->title }}
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        @if(Auth::user()->role == 2 && !(count($course_material_topic->course->instructors->where('id', Auth::id())) == 0))
                                        <a href="{{ route('assignments.edit', $assignment->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                            <span x-data="{ open: false }">
                                            <a class="ml-3 text-red-600 hover:text-red-900" @click="open = true">Delete</a>
                                            <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open">
                                                <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-6 md:mx-0" @click.away="open = false">
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                            Delete material
                                                        </h3>
            
                                                        <div class="mt-5">
                                                            <p class="text-sm leading-5 text-gray-500">
                                                                Are you sure you want to delete {{ $assignment->title }}?
                                                            </p>
                                                        </div>
                                                    </div>
            
                                                    <div class="mt-5 sm:mt-6">
                                                        <span class="flex flex-row-reverse w-full rounded-md shadow-sm">
                                                            <button onclick="event.preventDefault(); document.getElementById('delete-form{{ $assignment->title }}').submit();" class="inline-flex justify-center w-2/6 px-4 py-2 text-white bg-red-600 rounded hover:bg-red-900">
                                                                Delete
                                                            </button>
                                                            <button @click="open = false" class="mr-3 inline-flex justify-center w-2/6 px-4 py-2 text-gray-700">
                                                                Cancel
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <form id="delete-form{{ $assignment->title }}" action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
            
                                                </div>
                                            </div>
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            
                            @if(Auth::user()->role == 2 && !(count($course_material_topic->course->instructors->where('id', Auth::id())) == 0))
                            <tr>
                                <td></td>
                                <td>
                                    
                                    <div class="flex justify-end">
                                        <span x-data="{ open: false }">
                                            <button type="submit" class="px-6 py-3 rounded-md text-blue-600 font-medium tracking-wide hover:text-blue-900 ml-3" @click="open = true">
                                                <i class="fas fa-plus"></i> Add new material
                                            </button>
                                            <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open">
                                                <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-6 md:mx-0" @click.away="open = false">
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                            Choose category
                                                        </h3>
            
                                                        <div class="mt-5">
                                                            <div class="container flex mx-auto w-full items-center justify-center">
    
                                                                <ul class="flex flex-col bg-gray-300 p-4">
                                                                    <a href="#" onclick="document.getElementById('assignmentForm{{ $course_material_topic->id }}').submit();">
                                                                        <li class="border-gray-400 flex flex-row mb-2">
                                                                            <div class="select-none cursor-pointer bg-gray-200 rounded-md flex flex-1 items-center p-4  transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                                                                                <div class="flex flex-col rounded-md w-10 h-10 bg-gray-300 justify-center items-center mr-4">
                                                                                    <i class="far fa-file-archive"></i>
                                                                                </div>
                                                                                <div class="flex-1 pl-1 mr-16">
                                                                                    <div class="font-medium">Assignment</div>
                                                                                    <div class="text-gray-600 text-sm">Submit assignment questions for learners to submit</div>
                                                                                </div>
                                                                            </div>
                                                                            <form id="assignmentForm{{ $course_material_topic->id }}" action="{{ route('assignments.create') }}">
                                                                                @csrf
                                                                                <input type="hidden" value="{{ $course_material_topic->course_id }}" name="course_id">
                                                                                <input type="hidden" value="{{ $course_material_topic->id }}" name="topic">
                                                                            </form>
                                                                        </li>
                                                                    </a>
                                                                    <a href="#" onclick="document.getElementById('fileForm{{ $course_material_topic->id }}').submit();">
                                                                        <li class="border-gray-400 flex flex-row mb-2">
                                                                            <div class="select-none cursor-pointer bg-gray-200 rounded-md flex flex-1 items-center p-4  transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                                                                                <div class="flex flex-col rounded-md w-10 h-10 bg-gray-300 justify-center items-center mr-4">
                                                                                    <i class="far fa-file-alt"></i>
                                                                                </div>
                                                                                <div class="flex-1 pl-1 mr-16">
                                                                                    <div class="font-medium">File/Video</div>
                                                                                    <div class="text-gray-600 text-sm">Submit course material files for learners</div>
                                                                                </div>
                                                                            </div>
                                                                            <form id="fileForm{{ $course_material_topic->id }}" action="{{ route('course-materials.create') }}">
                                                                                @csrf
                                                                                <input type="hidden" value="{{ $course_material_topic->course_id }}" name="course_id">
                                                                                <input type="hidden" value="{{ $course_material_topic->id }}" name="topic">
                                                                            </form>
                                                                        </li>
                                                                    </a>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="mt-5 sm:mt-6">
                                                        <span class="flex flex-row-reverse w-full rounded-md shadow-sm">
                                                            <button @click="open = false" class="mr-3 inline-flex justify-center w-2/6 px-4 py-2 text-gray-700">
                                                                Cancel
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                        
                                    </div>
                                </td>
                            </tr>
                            @endif
                            
                        @endforeach
                        @if(Auth::user()->role == 2 && !(count($course_material_topic->course->instructors->where('id', Auth::id())) == 0))
                        <tr class="border-t">
                            <td></td>
                            <td>
                                <div class="flex justify-end">
                                    <form action="{{ route('course-material-topics.create') }}">
                                        @csrf
                                        <input type="hidden" value="{{ $course_material_topic->course_id }}" name="course_id">
                                        <button type="submit" class="px-6 py-3 rounded-md text-blue-600 font-medium tracking-wide hover:text-blue-900 ml-3">
                                            <i class="fas fa-plus"></i> Add new topic
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endif

@endsection