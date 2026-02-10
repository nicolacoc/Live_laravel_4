<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Ausiliari_film\FilmName;
use App\Http\Controllers\Ausiliari_film\Language_categories;
use App\Http\Controllers\Ausiliari_film\Search;
use App\Http\Requests\Film_ins_upd_Request;
use App\Models\Actor;
use App\Models\Film;
use App\Models\Film_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use stdClass;
use function Laravel\Prompts\error;
use function PHPUnit\Framework\isNull;

class film_controller extends Controller
{
    function index(Request $request)
    {
        $page = $request->page ?? 1;
        $search = ((!empty($request->input('search')))) ? $request->input('search') : '';

        if (!empty($search)) {
            $actors_list = Search::Film_search($search, $page);
        } else {


            $actors_list = Cache::remember('actors_list_page' . $page, 60, function () use ($page) {

                return Actor::query()->with(['films'])->paginate(3, ['*'], 'page');

            });
        }

            $film = Cache::remember('Films_page' . $page.'_'.$search, 60, function () use ($actors_list) {

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


    function show_edit(Request $request)
    {
        $film_sql = Film::query()
            ->with('Language')
            ->with('original_language')
            ->with('category')
            ->findorfail($request->id);

        $film_category_sql = Film_category::query()->findOrNew($film_sql->film_id);

        $film_category_sql['category_id'] = (empty($film_category_sql->category_id)) ? 0 : $film_category_sql->category_id;

        $film = new stdClass();
        $film->film_id = (!empty($request->old(Film::Film_id_name))) ? $request->old(Film::Film_id_name) : $film_sql->film_id;
        $film->title = (!empty($request->old(Film::Title_name))) ? $request->old(Film::Title_name) : $film_sql->title;
        $film->description = (!empty($request->old(Film::Description_name))) ? $request->old(Film::Description_name) : $film_sql->description;
        $film->category_id = (!empty($request->old(Film_category::Category_id_name)))? $request->old(Film_category::Category_id_name) : $film_category_sql->category_id;
        $film->length = (!empty($request->old(Film::Length_name))) ? $request->old(Film::Length_name) : $film_sql->length;
        $film->release_year = (!empty($request->old(Film::Release_year_name))) ? $request->old(Film::Release_year_name) : $film_sql->release_year;
        $film->language_id = (!empty($request->old(Film::Language_id_name))) ? $request->old(Film::Language_id_name) : $film_sql->language_id;
        $film->original_language_id = (!empty($request->old(Film::Original_language_id_name))) ? $request->old(Film::Original_language_id_name) : $film_sql->original_language_id;
        $film->replacement_cost = (!empty($request->old(Film::Replacement_cost_name))) ? $request->old(Film::Replacement_cost_name) : $film_sql->replacement_cost;

        $name = FilmName::getFilmsNames();
        $url = route('films_admin.update',['id'=>$film->film_id]);
        list($languages, $original_languages, $categories) = Language_categories::get_Language_categories($film);


        return view('film_edit', [
            'film' => $film,
            'languages' => $languages,
            'original_languages' => $original_languages,
            'categories' => $categories,
            'name' => $name,
            'url' => $url
        ]);
    }

    function show_create(Request $request)
    {
        $film = new stdClass();
        $film->film_id = (!empty($request->old(Film::Film_id_name))) ? $request->old(Film::Film_id_name) : 0;
        $film->title = (!empty($request->old(Film::Title_name))) ? $request->old(Film::Title_name) : '';
        $film->description = (!empty($request->old(Film::Description_name))) ? $request->old(Film::Description_name) : '';
        $film->category_id = (!empty($request->old(Film_category::Category_id_name)))? $request->old(Film_category::Category_id_name) : 0;
        $film->length = (!empty($request->old(Film::Length_name))) ? $request->old(Film::Length_name) : '';
        $film->release_year = (!empty($request->old(Film::Release_year_name))) ? $request->old(Film::Release_year_name) : '';
        $film->language_id = (!empty($request->old(Film::Language_id_name))) ? $request->old(Film::Language_id_name) : 0;
        $film->original_language_id = (!empty($request->old(Film::Original_language_id_name))) ? $request->old(Film::Original_language_id_name) : 0;
        $film->replacement_cost = (!empty($request->old(Film::Replacement_cost_name))) ? $request->old(Film::Replacement_cost_name) : '';

        $name = FilmName::getFilmsNames();
        $url = route('films_admin.insert');
        list($languages, $original_languages, $categories) = Language_categories::get_Language_categories($film);

        return view('film_edit', [
            'film' => $film,
            'languages' => $languages,
            'original_languages' => $original_languages,
            'categories' => $categories,
            'name' => $name,
            'url' => $url
        ]);
    }


    function insert(Film_ins_upd_Request $request)
    {
        $all = $request->all();


        $film = [];
        $film[Film::Title_name] = $all[Film::Title_name];
        $film[Film::Description_name] = $all[Film::Description_name];
        $film[Film::Length_name] = $all[Film::Length_name];
        $film[Film::Release_year_name] = $all[Film::Release_year_name];
        $film[Film::Language_id_name] = $all[Film::Language_id_name];
        $film[Film::Original_language_id_name] = $all[Film::Original_language_id_name];
        $film[Film::Replacement_cost_name] = $all[Film::Replacement_cost_name];
        $film[Film::Slug_name] = Str::slug($all[Film::Title_name]);




        $film = Film::factory()->create($film);

        $film_category = new Film_category;
        $film_category->film_id = $film->film_id;
        $film_category->category_id = $all[Film_category::Category_id_name];
        $film_category_ok= $film_category->save();
        Cache::flush();

        if ($film&&$film_category_ok) {
            return redirect()
                ->route('films_admin.index')
                ->with(['message'=>'Film Inserito con successo']);

        } else {
            return redirect()
                ->route('films_admin.index')
                ->withErrors(['error'=>'Errore durante l\'inserimento']);

        }

    }

    function update(Film_ins_upd_Request $request)
    {
        $all = $request->all();
        $all[Film::Slug_name] = Str::slug($all[Film::Title_name]);;

        $film = Film::query()->findOrFail($request->id)->update($all);

        $film_category = Film_category::query()->findOrNew($request->id);
        $film_category->film_id = $all[Film::Film_id_name];
        $film_category->category_id = $all[Film_category::Category_id_name];
        $film_category_ok= $film_category->save();

        Cache::flush();

        if ($film&&$film_category_ok) {
            return redirect()
                ->route('films_admin.index')
                ->with(['message'=>'Film Aggiornato con successo']);

        } else {
            abort(404, 'Film not found');
        }
    }

    function delete(Request $request)
    {
        $film_category = Film_category::query()->findOrfail($request->id)->delete();

        if ($film_category) {
            $film = Film::query()->findorfail($request->id)->delete();
        }else{
            $film=false;
        }
        Cache::flush();

        if ($film) {
            return redirect()
                ->back()
                ->with(['message' => 'Film cancellato con successo']);
        } else {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Errore durante la cancellazione']);
        }

    }


    function Index_admin(Request $request)
    {

        $films = Cache::remember('film_admin_' . $request->id, 60, function () use ($request) {

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
                $film['original_language'] = $film['original_language'] ? $film->original_language->name : 'null';
                $film['category'] = $film['category'] ? $film->category->name : 'null';
                return $film;
            });


        });

        return view('Films_admin', ['films' => $films]);
    }



}
