<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(!empty($actor->first_name))
                Edit - {{$actor->first_name}} {{$actor->last_name}}
            @else
                Insert
            @endif
        </h2>
    </x-slot>

    <div class="container">
        <x-message :errors="$errors"/>
        <div class="row bg-white p-5 rounded shadow m-3">
            <form action="{{$url}}" method="post">
                <input type="hidden" name="{{$name->actor_id}}" value="{{$actor->actor_id}}">
                @csrf
                <div class="mb-3">
                    <label for="Name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" value="{{$actor->first_name}}" name="{{$name->first_name}}" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Cognome</label>
                    <input type="text" class="form-control" id="last_name" value="{{$actor->last_name}}" name="{{$name->last_name}}" required>
                </div>
                <div class="mb-3">
                    <h1 class="mb-2">Film</h1>
                    @foreach($films as $film)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$film->film_id}}" id="Film_{{$loop->index}}" name="{{$film_actor_name->film_id}}[]" {{$film->actual}}>
                        <label class="form-check-label" for="Film_{{$loop->index}}">
                            {{$film->title}}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
