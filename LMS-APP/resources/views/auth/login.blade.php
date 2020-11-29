
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="referrer" content="always">

        <title>@yield('title')</title>
        
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <script src="https://kit.fontawesome.com/ac2748b2eb.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="flex justify-center items-center h-screen bg-gray-200 px-6">
            <div class="p-6 max-w-sm w-full bg-white shadow-md rounded-md">
                <div class="flex justify-center items-center">
                    <span class="text-gray-700 font-semibold text-2xl">Portal</span>
                </div>

                <form class="mt-4" action="{{ route('login') }}" method="POST">
                    @csrf
                    <label class="block">
                        <span class="text-gray-700 text-sm">Username</span>
                        <input name="username" type="text" class="form-input mt-1 block w-full rounded-md focus:border-indigo-600">
                    </label>

                    <label class="block mt-3">
                        <span class="text-gray-700 text-sm">Password</span>
                        <input name="password" type="password" class="form-input mt-1 block w-full rounded-md focus:border-indigo-600">
                    </label>

                    <div class="flex justify-between items-center mt-4">
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600">
                                <span class="mx-2 text-gray-600 text-sm">Remember me</span>
                            </label>
                        </div>
                        
                        <div>
                            <a class="block text-sm fontme text-indigo-700 hover:underline" href="#">Forgot your password?</a>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="py-2 px-4 text-center bg-indigo-600 rounded-md w-full text-white text-sm hover:bg-indigo-500">
                            Sign in
                        </button>
                        <a href="{{ route('home') }}">
                            <button type="button" class="mt-3 py-2 px-4 text-center bg-black rounded-md w-full text-white text-sm hover:bg-gray-800">
                                Continue as guest
                            </button>
                        </a>
                    </div>
                </form>

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
            </div>
        </div>
    </body>
</html>



