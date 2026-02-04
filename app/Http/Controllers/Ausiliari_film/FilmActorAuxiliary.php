<?php

namespace App\Http\Controllers\Ausiliari_film;

use App\Http\Requests\Actor_ins_upd_Request;
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

    /**
     * @param int $id
     * @param Actor_ins_upd_Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function GetInsUpdFilmActor(int $id, Actor_ins_upd_Request $request): \Illuminate\Http\RedirectResponse
    {
        $film_actor = Film_actor::query()->where(Film_actor::actor_id_name, $id)->get();
        $film_id = collect($request->film_id);
        $film_id_count = $film_id->count();
        foreach ($film_actor as $film_id_n) {
            if (!$film_id->contains($film_id_n->film_id)) {
                $ok = Film_actor::query()->where(Film_actor::actor_id_name, $id)
                    ->where(Film_actor::film_id_name, $film_id_n->film_id)->delete();
            }
        };
        foreach ($film_id as $item) {
            $contains = $film_actor->contains(Film_actor::film_id_name, $item);
            if (!$contains) {
                $film_actor_new = new Film_actor();
                $film_actor_new->film_id = $item;
                $film_actor_new->actor_id = $id;
                $ok = $film_actor_new->save();
            } else {
                $ok = true;
            }
        }
        if ($film_id_count == 0) {
            $ok = true;
        }
        if (!empty($ok)) {
            return redirect()
                ->route('films_actor.index')
                ->with(['message' => 'Actor aggiornato con successo']);
        } else {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Errore durante l\'aggiornamento'])
                ->withInput($request->all());
        }
    }


}
