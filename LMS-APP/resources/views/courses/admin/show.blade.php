
<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <h2 class="text-xl text-gray-700 font-semibold capitalize">List of Learners</h2>
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
                    @foreach($course->learners as $user)
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
                            
     
                                @foreach ($user->batches as $user_batch)
                                    @if($loop->iteration%2==0)
                                        <br>
                                    @endif                                            
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{$user_batch->name}}
                                    </span>
                                @endforeach                                        

                                
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
                            
                            <span x-data="{ open: false }">

                                <a class="ml-3 text-red-600 hover:text-red-900" @click="open = true">Remove</a>
                                
                                <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open">

                                    
                                    <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-6 md:mx-0" @click.away="open = false">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                Remove user
                                            </h3>

                                            <div class="mt-5">
                                                <p class="text-sm leading-5 text-gray-500">
                                                    Are you sure you want to remove {{ $user->full_name }} from {{ $course->title }}?
                                                </p>
                                            </div>
                                        </div>

                                        <div class="mt-5 sm:mt-6">
                                            <span class="flex flex-row-reverse w-full rounded-md shadow-sm">
                                                <button onclick="event.preventDefault(); document.getElementById('remove-form{{ $user->id }}').submit();" class="inline-flex justify-center w-2/6 px-4 py-2 text-white bg-red-600 rounded hover:bg-red-900">
                                                    Remove
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
                        <form id="remove-form{{ $user->id }}" action="{{ route('course-learner.detach') }}" method="POST" class="hidden">
                            @csrf
                            <input type="hidden" value="{{ $course->id }}" name="course_id">
                            <input type="hidden" value="{{ $user->id }}" name="learner_id">
                        </form>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>          
        </div>
    </div>
</div>

<div class="flex justify-end mt-4">
    <a href="{{ route('course-learner.add', $course->id) }}">
        <button class="px-6 py-3 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3">
            Enrol learner
        </button>
    </a>
</div>