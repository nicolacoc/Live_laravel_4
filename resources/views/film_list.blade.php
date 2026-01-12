<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Film_List</title>
    @vite(['resources/js/app.js'])
</head>
<body>
<div class="container">
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
