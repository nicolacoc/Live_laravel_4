<?php

namespace App\Http\Controllers\Ausiliari_film;

use App\Models\Film;
use App\Models\Film_actor;
use Illuminate\Http\Request;
use stdClass;

class FilmActorAuxiliary
{

    /**
     * @param stdClass $film_actor_name
     * @param mixed $id
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public static function GetFilmInFilmActor(stdClass $film_actor_name, mixed $id, Request $request): \Illuminate\Support\Collection
    {
        $film_sql = Film::query()->get();
        $film_actor_sql = Film_actor::query()->where($film_actor_name->actor_id, $id)->orderBy($film_actor_name->film_id)->get();
        $film_actor_film_id = ((!empty($film_actor_sql))) ? $film_actor_sql->pluck($film_actor_name->film_id) : [];
        $film_actor = (($request->old($film_actor_name->film_id))) ? collect($request->old($film_actor_name->film_id)) : $film_actor_film_id;


        return $film_sql->map(function ($film) use ($film_actor) {
            foreach ($film_actor as $item) {
                if ($item == $film->film_id) {
                    $query = $item;
                    break;
                } else {
                    $query = [];
                }
            }

            $film['actual'] = ((!empty($query))) ? 'checked' : '';

            return $film;

        });

    }

}
