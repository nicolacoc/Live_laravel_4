<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Titolo</th>
        <th scope="col">Descrizione</th>
        <th scope="col">Lingua del film</th>
        <th scope="col">Anno di rilascio</th>
    </tr>
    </thead>
    <tbody>

    @foreach($film as $film_film)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$film_film->title}}</td>
            <td class="break-long-words">{{$film_film->description}}</td>
            <td>{{$film_film->language}}</td>
            <td>{{$film_film->release_year}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
