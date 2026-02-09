<x-app-public_view>
    <x-slot name="head">
        <style>
            div.search {
                width: 30%; margin: auto
            }
        </style>
    </x-slot>

    <div class="search">
        <form action="{{route('film.index')}}" method="get">
            <div class="input-group mb-3">
                <button class="btn btn-outline-primary" type="submit" id="button-addon1">Cerca</button>
                <input type="text" class="form-control" placeholder=""
                       aria-label="Inserisci il nome dell'attore" aria-describedby="button-addon1"
                name="search" value="{{request()->search}}">
            </div>
            </form>
    </div>
    <div class="text-center">
        <h1>Lista Film</h1>
    </div>
    <div>
    @foreach($actors as $actor)
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="text-body-secondary">Attore:</h6>
                <h5 class="card-title">{{$actor->Nome}} {{$actor->Cognome}}</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Films:</h6>
                <x-film_list_on_actor :film="$actor->films"/>
            </div>
        </div>
    @endforeach
    </div>
        {{$actors->links()}}
</x-app-public_view>
