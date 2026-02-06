<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/js/app.js'])
</head>
<body>
<div class="container">
    <header>
        @include('layouts.public.Navbar')
    </header>
    <main class="mt-5">
        <div class="raw">
            <div class="col-12">
                {{$slot}}
            </div>
        </div>
    </main>
    <footer>
        @include('layouts.public.Footer')
    </footer>
</div>
</body>
</html>
