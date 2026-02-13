<x-app-public_view>
    <x-slot name="head">
       @vite('resources/css/detail.css')
    </x-slot>
<div class="sfondo p-4">
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="text-body-secondary">Attore:</h6>
                <h5 class="card-title">{{$actor->Nome}} {{$actor->Cognome}}</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Films:</h6>
                <x-film_list_on_actor :film="$actor->films"/>
            </div>
        </div>
</div>
</x-app-public_view>
