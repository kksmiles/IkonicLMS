<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
    
<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <img class="h-12 w-12" src="/img/graduation-icon.svg" alt="graduation icon">
            <span class="text-white text-2xl mx-2 font-semibold">IkonicLMS</span>
        </div>
    </div>

    <nav class="mt-10">
        <a class="flex items-center mt-4 py-2 px-6 bg-gray-700 bg-opacity-25 text-gray-100" href="/">
            <span class="h-6 w-6">
                <i class="fas fa-home"></i>
            </span>
            <span class="mx-3">Site Home</span>
        </a>

        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/ui-elements">
            <span class="h-6 w-6">
                <i class="fas fa-columns"></i>
            </span>

            <span class="mx-3">Dashboard</span>
        </a>

        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/tables">
            <span class="h-6 w-6">
                <i class="fas fa-search"></i>
            </span>

            <span class="mx-3">Search</span>
        </a>

        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/forms">
            <span class="h-6 w-6">
                <i class="far fa-calendar-alt"></i>
            </span>

            <span class="mx-3">Calendar</span>
        </a>
    </nav>
</div>