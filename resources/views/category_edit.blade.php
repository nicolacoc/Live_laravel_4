<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(!empty($category->name))
                Edit - {{$category->name}}
            @else
                Insert
            @endif
        </h2>
    </x-slot>

    <div class="container">
        <x-message :errors="$errors" />
        <div class="row bg-white p-5 rounded shadow m-3">
            <form action="{{$url}}" method="post">
                <input type="hidden" name="{{$name->category_id}}" value="{{$category->category_id}}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome Categoria</label>
                    <input type="text" class="form-control" id="name" value="{{$category->name}}" name="{{$name->name}}" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
