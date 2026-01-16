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
use function Laravel\Prompts\error;

class film_controller extends Controller
{
    function index(Request $request)
    {
        $page = $request->page ?? 1;





        $actors_list = Cache::remember('actors_list_page'.$page, 60, function () use ($page) {

            return Actor::query()->with(['films'])->paginate(3,['*'],'page');

        });

        $film = Cache::remember('Films_page'.$page, 60, function () use ($actors_list) {

            return $actors_list->through(function ($actor) {

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
        $film = Film::query()->findorfail($request->id)->delete();

        Cache::forget('films_list');
        Cache::flush();
        if ($film) {
            return redirect()->back();
        }else{
             abort(404, 'Film not found');
        }

    }




    function Index_admin(Request $request)
    {

        $films= Cache::remember('film_admin_' . $request->id, 60, function () use ($request) {

            $films_list = Film::query()
                ->with('actors')
                ->with('language')
                ->with(['original_language' => function ($query) {
                    $query->select('name', 'language_id');
                }])
                ->with('category')
                ->with(['Film_Text' => function ($query) {
                    $query->select('description', 'film_id');
                }])
                ->get();

            return $films_list->map(function (Film $film) {
                $film['original_language'] = $film['original_language']?$film->original_language->name:'null';
                $film['category'] = $film['category']?$film->category->name:'null';
                return $film;
            });


        });

      return view('Films_admin', ['films' => $films]);
    }

}
