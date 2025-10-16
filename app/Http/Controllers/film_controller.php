<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Film;
use Illuminate\Http\Request;
use stdClass;

class film_controller extends Controller
{
    function index(Request $request){
        $query1 = Actor::query()->with('films')->paginate();
        $actors = $query1;

      return $actors->through(function($actor){
            $new_actor = new stdClass();
            $new_actor->Nome=$actor->first_name;
            $new_actor->Cognome=$actor->last_name;
            $new_actor->films=$actor->films->map(fn ($film)=>$film->title)->toArray();
            return $new_actor;
        });



    }

    function insert(Request $request){
        $film = new Film();
        $film->title= $request->title;
        $film->language_id= 1;
        $film->original_language_id= 1;
        $film->save();
    }

    function update(Request $request){
        $film= Film::find($request->id);
        $film->title = $request->title;
        $film->save();
    }

    function delete(Request $request){
        $film = Film::find($request->id);
        $film->delete();
    }

    function prova(Request $request){
       $film_query = Film::query()->with([
           'actors',
           'language',
           'original_language',
           'category',
           'Film_Text'
           ])
           ->find($request->id);

$film = $film_query;



        return $film;
    }

}
