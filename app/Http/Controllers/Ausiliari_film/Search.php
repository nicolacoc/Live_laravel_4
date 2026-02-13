<?php

namespace App\Http\Controllers\Ausiliari_film;

use App\Models\Actor;
use App\Models\Film;
use Illuminate\Support\Facades\Cache;

class Search
{
    /**
     * @param mixed $search
     * @param mixed $page
     * @return mixed
     */
    public static function Film_search(mixed $search, mixed $page): mixed
    {
        $film_list = Cache::remember('films_search_' . $search . '_' . $page, 60, function () use ($search, $page) {

            return Film::search($search)
                ->options(['query_by' => 'title'])
                ->get();
        });


        if (!$film_list->isEmpty()) {
            $actors_list = Cache::remember('actors_search_' . $search . '_' . $page, 5, function () use ($search, $page, $film_list) {
                return Actor::query()
                    ->with(['films'])
                    ->whereHas('films', function ($query) use ($film_list) {
                        $query->whereIn('film.film_id', $film_list->pluck('film_id'));
                    })
                    ->paginate(15, ['*'], 'page')
                    ->withPath('?search=' . $search);
            });

        } else {
            $actors_list = Cache::remember('actors_search_' . $search . '_' . $page, 5, function () use ($search, $page) {


                return Actor::query()
                    ->whereFullText(['first_name', 'last_name'], $search)
                    ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->paginate(15, ['*'], 'page')
                    ->withPath('?search=' . $search);

            });

        }
        return $actors_list;
    }

}
