<?php

namespace App\Http\Controllers;

use App\Http\Requests\Film_ins_upd_Request;
use App\Models\Actor;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use stdClass;

class film_controller extends Controller
{
    function index(Request $request)
    {

        return Cache::remember('films_list', 60, function () {

            $actors = Actor::query()->with(['films' => function ($query) {

                $query->select('title', 'actor_id');

            }])->paginate();


            return $actors->through(function ($actor) {
                $new_actor = new stdClass();
                $new_actor->Nome = $actor->first_name;
                $new_actor->Cognome = $actor->last_name;
                $new_actor->films = $actor->films->map(fn($film) => $film->title)->toArray();
                return $new_actor;
            });

        });

    }

    function insert(Film_ins_upd_Request $request)
    {

        $all = $request->all();

        $all[Film::Slug_name] = Str::slug($all[Film::Title_name]);


        $film = Film::factory()->create($all);

        Cache::forget('films_list');
        Cache::flush();

        return $film;

    }

    function update(Film_ins_upd_Request $request)
    {
        $all = $request->all();
        $all[Film::Slug_name] = Str::slug($all[Film::Title_name]);;

        $film = Film::query()->findOrFail($request->id)->update($all);

        Cache::forget('films_list');
        Cache::flush();

        return $film;
    }

    function delete(Request $request)
    {
        $film = Film::findOrFail($request->id)->delete();

        Cache::forget('films_list');
        Cache::flush();

        return $film;
    }

    function prova(Request $request)
    {

        return Cache::remember('film_' . $request->id, 60, function () use ($request) {

            return Film::query()
                ->with('actors')
                ->with('language')
                ->with('original_language')
                ->with('category')
                ->with(['Film_Text' => function ($query) {
                    $query->select('description', 'film_id');
                }])
                ->find($request->id);


        });


    }

}
