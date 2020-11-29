<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
    
<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <img class="h-12 w-12" src="/img/graduation-icon.svg" alt="graduation icon">
            <span class="text-white text-2xl mx-2 font-semibold">IkonicLMS</span>
        </div>
    </div>

    <nav class="mt-10">
        @if(!Auth::check())
        <a class="{{ Route::currentRouteNamed('home') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('home') }}">
            <span class="h-6 w-6">
                <i class="fas fa-home"></i>
            </span>
            <span class="mx-3">Site Home</span>
        </a>
        @else
            @if(Auth::user()->role==1)
                <a class="{{ Route::currentRouteNamed('home') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('home') }}">
                    <span class="h-6 w-6">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="mx-3">Site Home</span>
                </a>

                <a class="{{ \Request::is('departments') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('departments.index') }}">
                    <span class="h-6 w-6">
                        <i class="fas fa-building"></i>
                    </span>

                    <span class="mx-3">Departments</span>
                </a>

                <a class="{{ \Request::is('courses') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('courses.index') }}">
                    <span class="h-6 w-6">
                        <i class="fas fa-book-open"></i>
                    </span>

                    <span class="mx-3">Courses</span>
                </a>
                <a class="{{ \Request::is('batches') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('batches.index') }}">
                    <span class="h-6 w-6">
                        <i class="fas fa-users-cog"></i>
                    </span>

                    <span class="mx-3">Batches</span>
                </a>
                <a class="{{ \Request::is('users') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('users.index') }}">
                    <span class="h-6 w-6">
                        <i class="fas fa-users"></i>
                    </span>

                    <span class="mx-3">Users</span>
                </a>
                @elseif(Auth::user()->role==2 || Auth::user()->role==3 )
                
                <a class="{{ Route::currentRouteNamed('home') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('home') }}">
                    <span class="h-6 w-6">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="mx-3">Site Home</span>
                </a>

                <a class="{{ Route::currentRouteNamed('dashboard') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('dashboard') }}">
                    <span class="h-6 w-6">
                        <i class="fas fa-columns"></i>
                    </span>

                    <span class="mx-3">Dashboard</span>
                </a>

                <a class="{{ Route::currentRouteNamed('search') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('search') }}">
                    <span class="h-6 w-6">
                        <i class="fas fa-search"></i>
                    </span>

                    <span class="mx-3">Search</span>
                </a>

                <a class="{{ Route::currentRouteNamed('calendar') ? 'sidebar-nav-active' : 'sidebar-nav-inactive' }}" href="{{ route('calendar') }}">
                    <span class="h-6 w-6">
                        <i class="far fa-calendar-alt"></i>
                    </span>

                    <span class="mx-3">Calendar</span>
                </a>
            @endif
        @endif
    </nav>
</div>