<header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        <div class="relative mx-4 lg:mx-0">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <span class="h-5 w-5 text-gray-500">
                    <i class="fas fa-search"></i>
                </span>
            </span>

            <input class="form-input w-32 sm:w-64 md:w-64 lg:w-auto xl:w-auto rounded-md pl-10 pr-4 focus:border-indigo-600" type="text" placeholder="Search for courses and users">
            {{-- <button class="px-4 py-2 bg-indigo-600 rounded-md text-white font-medium tracking-wide hover:bg-indigo-500 ml-3 invisible sm:invisible md:invisible lg:visible xl:visible">Search</button> --}}
        </div>
    </div>
    
    <div class="flex items-center">
        
        @if(Auth::check())
            <div x-data="{ dropdownOpen: false }"  class="relative">
                <button @click="dropdownOpen = ! dropdownOpen" class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                    <img class="h-full w-full object-cover" src="{{ Auth::user()->getImageURL() }}" alt="Your avatar">
                </button>
                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
                <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
                    <a href="{{ route('users.show', Auth::id()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                    <a href="{{ route('gradebook') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Gradebook</a>
                    <hr>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
            @else
            <span>Guest User</span>
            <img class="ml-2 h-8 w-8 object-cover" src="{{ asset('/img/user-default-avatar.svg') }}" alt="Your avatar">
            <span class="ml-2">
                (<a href="{{ route('login') }}" class="underline text-blue-400">Log In</a>)
            </span>
        @endif
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</header>