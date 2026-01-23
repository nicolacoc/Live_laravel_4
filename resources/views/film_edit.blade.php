<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(!empty($film->title))
                Edit - {{$film->title}}
            @else
                Insert
            @endif
        </h2>
    </x-slot>

    <div class="container">
        @if ($errors->any())
            @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
            @endforeach
        @endif

        <div class="row bg-white p-5 rounded shadow m-3">
            <form action="{{$url}}" method="post">
                <input type="hidden" name="{{$name->film_id}}" value="{{$film->film_id}}">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control" id="title" value="{{$film->title}}" name="{{$name->title}}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="description"
                              rows="3" name="{{$name->description}}" required>{{$film->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="release_year" class="form-label">Anno di rilascio</label>
                    <input type="number" class="form-control" id="release_year" value="{{$film->release_year}}"
                           name="{{$name->release_year}}" required>
                </div>
                <div class="mb-3">
                    <label for="length" class="form-label">Lunghezza</label>
                    <input type="number" class="form-control" id="length" value="{{$film->length}}"
                           name="{{$name->length}}" required>
                </div>
                <div class="mb-3">
                    <label for="Languages" class="form-label">Lingua del film</label>
                    <select id="Languages" class="form-select" name="{{$name->language_id}}">
                        @foreach($languages as $language)
                            <option value="{{$language->language_id}}" {{$language->actual}}>{{$language->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Original_Languages" class="form-label">Lingua del film originale</label>
                    <select id="Original_Languages" class="form-select" name="{{$name->original_language_id}}">
                        @foreach($original_languages as $o_language)
                            <option value="{{$o_language->language_id}}" {{$o_language->actual}}>{{$o_language->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Categories" class="form-label">Categoria del film</label>
                    <select id="Categories" class="form-select" name="{{$name->category_id}}">
                        @foreach($categories as $category)
                            <option value="{{$category->category_id}}" {{$category->actual}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="replacement_cost" class="form-label">Costo</label>
                    <input type="number" class="form-control" id="replacement_cost" value="{{$film->replacement_cost}}"
                           name="{{$name->replacement_cost}}" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
