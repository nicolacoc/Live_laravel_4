<?php

namespace App\Http\Controllers\Ausiliari_film;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Film;
use App\Models\Film_actor;
use App\Models\Film_category;
use stdClass;

class FilmName
{
    public static function getFilmsNames(): stdClass
    {
        $name = new stdClass();
        $name->film_id = Film::Film_id_name;
        $name->title = Film::Title_name;
        $name->description = Film::Description_name;
        $name->length = Film::Length_name;
        $name->release_year = Film::Release_year_name;
        $name->language_id = Film::Language_id_name;
        $name->original_language_id = Film::Original_language_id_name;
        $name->replacement_cost = Film::Replacement_cost_name;
        $name->category_id = Film_category::Category_id_name;
        return $name;
    }

    public static function getCategoryNames(){
        $name = new stdClass();
        $name->category_id = Category::Category_id_name;
        $name->name = Category::Name_name;
        return $name;
    }

    public static function getFilmCategoryNames(){
        $name = new stdClass();
        $name->film_id = Film_category::Film_id_name;
        $name->category_id = Film_category::Category_id_name;
        return $name;
    }

    public static function getActorNames(){
        $name = new stdClass();
        $name->actor_id = Actor::actor_id_name;
        $name->first_name = Actor::First_name_name;
        $name->last_name = Actor::Last_name_name;
        return $name;
    }

    public static function getFilmActorNames(){
        $name = new stdClass();
        $name->film_id = Film_actor::film_id_name;
        $name->actor_id = Film_actor::actor_id_name;
        return $name;
    }
}
