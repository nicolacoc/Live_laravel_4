<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Film_List</title>
    @vite(['resources/js/app.js'])
</head>
<body>
<div class="container">
    <header>
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </header>
    <main>
    @foreach($actors as $actor)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{$actor->Nome}} {{$actor->Cognome}}</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Films:</h6>
                    <x-film_list_on_actor :film="$actor->films"/>
            </div>
        </div>
    </main>
    @endforeach
    {{$actors->links()}}
</div>
</body>
</html>
