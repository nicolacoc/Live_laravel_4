<x-app-public_view>
    <x-slot name="head">
        @vite(['resources/css/list.css'])
    </x-slot>

    <div class="search bg-white">
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
        <h1>Lista Attori</h1>
    </div>
    <div class="actor_list">
    @foreach($actors as $actor)
        <div class="card mb-3 bg-white">
            <div class="card-body">
                <h6 class="text-body-secondary">Attore:</h6>
                <a href="{{route('film.detail', ['id'=>$actor->id])}}" ><h5 class="card-title">{{$actor->Nome}} {{$actor->Cognome}}</h5></a>

            </div>
        </div>
    @endforeach
    </div>
        {{$actors->links()}}
</x-app-public_view>
