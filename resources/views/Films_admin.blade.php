<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Films
        </h2>
    </x-slot>

    <div class="container">
       <x-message :errors="$errors" />
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between m-3">
                    <a class="btn btn-primary ms-auto" href="{{route('films_admin.edit.insert')}}" role="button">Nuovo</a>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table break-long-words">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Anno di Rilascio</th>
                    <th scope="col">Lunghezza</th>
                    <th scope="col">Lingua</th>
                    <th scope="col">Lingua Originale</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">--</th>
                </tr>
                </thead>
                <tbody>
                @foreach($films as $film)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$film->title}}</td>
                        <td class="break-long-words">{{$film->description}}</td>
                        <td>{{$film->release_year}}</td>
                        <td>{{$film->length}}</td>
                        <td>{{$film->language->name}}</td>
                        <td>{{$film->original_language}}</td>
                        <td>{{$film->category}}</td>
                        <td>
                            <form action="{{route('films_admin.edit', ['id'=>$film->film_id])}}" method="get">
                                <button type="submit" class="btn btn-sm btn-secondary m-2" role="button">Edita</button>
                            </form>
                            <form action="{{route('films_admin.delete', ['id'=>$film->film_id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" role="button">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
