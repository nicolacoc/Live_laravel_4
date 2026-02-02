<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Ausiliari_film\FilmActorAuxiliary;
use App\Http\Controllers\Ausiliari_film\FilmName;
use App\Http\Requests\Actor_ins_upd_Request;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use stdClass;
use function PHPSTORM_META\type;
use function PHPUnit\Framework\isNull;

class actor_controller extends Controller
{
    public function index(Request $request)
    {
    }

    public function index_admin(Request $request)
    {


        $actor = Cache::remember('actor_list', 60, function () {
            $actor_sql = Actor::query()->get();
            return $actor_sql->map(function ($actor) {
                $item = new \stdClass();
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
        $actor = Actor::query()->findorfail($id);

        if (!empty($actor)) {
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

    public function create()
    {
    }

    public function edit()
    {
    }

    public function update(Actor_ins_upd_Request $request)
    {
        Cache::flush();
        $actor= Actor::query()->findorfail($request->id)
            ->update($request->only(Actor::First_name_name, Actor::Last_name_name));



        return redirect()
            ->back()
            ->withInput($request->all());
    }

    public function delete()
    {
    }


}
