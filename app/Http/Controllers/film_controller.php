<?php

namespace App\Http\Controllers;

use App\Http\Requests\Film_ins_upd_Request;
use App\Models\Actor;
use App\Models\Film;
use App\Models\Film_actor;
use App\Models\Film_language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use stdClass;

class film_controller extends Controller
{
    function index(Request $request)
    {
        $page = $request->page ?? 1;





        $actors_list = Cache::remember('actors_list_page'.$page, 60, function () use ($page) {

            return Actor::query()->with(['films'])->paginate(3,['*'],'page');

        });

        $film = Cache::remember('Films_page'.$page, 60, function () use ($page, $actors_list) {

            return $actors_list->through(function ($actor) use ($page) {

                $films = Film::query()
                    ->with('Language')
                    ->with('category')
                    ->with('actors')
                    ->wherehas('actors', function ($query) use ($actor) {
                    $query->where('actor.actor_id', $actor->actor_id);
                })->get();

                $new_actor = new stdClass();
                $new_actor->Nome = $actor->first_name;
                $new_actor->Cognome = $actor->last_name;
                $new_actor->Prima_lettera = Str::substr($actor->first_name, 0, 1);
                $new_actor->films = $films->map(function ($film) {
                    $films = new stdClass();
                    $films->language = $film->Language->name;
                    $films->title = $film->title;
                    $films->description = $film->description;
                    $films->release_year = $film->release_year;
                    return $films;
                });
                return $new_actor;
            });
        });


        return view('film_list', ['actors' => $film]);



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
