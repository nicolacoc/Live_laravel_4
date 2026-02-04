<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Ausiliari_film\FilmActorAuxiliary;
use App\Http\Controllers\Ausiliari_film\FilmName;
use App\Http\Requests\Actor_ins_upd_Request;
use App\Models\Actor;
use App\Models\Film_actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use stdClass;

class actor_controller extends Controller
{
    public function index(Request $request)
    {
    }

    public function index_admin()
    {


        $actor = Cache::remember('actor_list', 60, function () {
            $actor_sql = Actor::query()->get();
            return $actor_sql->map(function ($actor) {
                $item = new stdClass();
                $item->nome = $actor->first_name;
                $item->cognome = $actor->last_name;
                $item->id = $actor->actor_id;
                return $item;
            });

        });

        return view('actor_admin_list', ['actors' => $actor]);
    }

    public function show_edit(Request $request)
    {
        $id = $request->id;
        $name = FilmName::getActorNames();
        $film_actor_name = FilmName::getFilmActorNames();
        $url = route('films_actor.update', ['id' => $id]);
        $actor_sql = Actor::query()->findorfail($id);
        if (!empty($actor_sql)) {
            $actor = new stdClass();
            $actor->first_name = ((!empty($request->old(Actor::First_name_name))))?$request->old(Actor::First_name_name):$actor_sql->first_name;
            $actor->last_name = ((!empty($request->old(Actor::Last_name_name))))?$request->old(Actor::Last_name_name):$actor_sql->last_name;
            $actor->actor_id = $actor_sql->actor_id;
            $film = FilmActorAuxiliary::GetFilmInFilmActor($film_actor_name, $id, $request);
            return view('actor_edit', [
                'actor' => $actor,
                'films' => $film,
                'url' => $url,
                'name' => $name,
                'film_actor_name' => $film_actor_name
            ]);


        } else {
            return redirect()
                ->route('films_actor.index')
                ->withErrors(['error' => 'Errore durante l\'aggiornamento']);

        }
    }

    public function show_create(Request $request)
    {
        $name = FilmName::getActorNames();
        $film_actor_name = FilmName::getFilmActorNames();
        $url = route('films_actor.insert');
        $id = 0;
        $actor = new stdClass();
        $actor->first_name = ((!empty($request->old(Actor::First_name_name))))?$request->old(Actor::First_name_name):'';
        $actor->last_name = ((!empty($request->old(Actor::Last_name_name))))?$request->old(Actor::Last_name_name):'';
        $actor->actor_id = $id;
        $film = FilmActorAuxiliary::GetFilmInFilmActor($film_actor_name, $id, $request);
        return view('actor_edit', [
            'actor' => $actor,
            'films' => $film,
            'url' => $url,
            'name' => $name,
            'film_actor_name' => $film_actor_name
        ]);


    }

    public function insert(Actor_ins_upd_Request $request){
        Cache::flush();
        $actor = Actor::query()->create($request->only(Actor::First_name_name, Actor::Last_name_name));
        $id = $actor->actor_id;
        if (!empty($actor)) {
            return FilmActorAuxiliary::GetInsUpdFilmActor($id, $request);
        } else {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Errore durante l\'inserimento'])
                ->withInput($request->all());
        }
    }

    public function update(Actor_ins_upd_Request $request)
    {
        Cache::flush();
        $id = $request->id;
        $actor = Actor::query()->findorfail($id)
            ->update($request->only(Actor::First_name_name, Actor::Last_name_name));
        if ($actor) {
            return FilmActorAuxiliary::GetInsUpdFilmActor($id, $request);
        } else {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Errore durante l\'aggiornamento'])
                ->withInput($request->all());
        }

    }

    public function delete(Request $request)
    {
        Cache::flush();
        $film_actor_count = Film_actor::query()->where(Film_actor::actor_id_name, $request->id)->count();
        if ($film_actor_count > 0) {
            $film_actor = Film_actor::query()->where(Film_actor::actor_id_name, $request->id)->delete();
        }else{
            $film_actor=true;
        }
        if (!empty($film_actor)) {
            $actor = Actor::query()->findorfail($request->id)->delete();


            if ($actor) {
                return redirect()
                    ->route('films_actor.index')
                    ->with(['message' => 'Attore eliminato con successo']);
            } else {
                return redirect()
                    ->back()
                    ->withErrors(['error' => 'Errore durante l\'eliminazione']);
            }
        }else{
            return redirect()
                ->back()
                ->withErrors(['error' => 'Errore durante l\'eliminazione']);
        }
    }


}
