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

    /**
     * @property string film_id
     * @property string title
     * @property string description
     * @property string length
     * @property string release_year
     * @property string language_id
     * @property string original_language_id
     * @property string replacement_cost
     * @property string category_id
     * */

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

    /**
     * @property string category_id
     * @property string name
     * */

    public static function getCategoryNames(): stdClass{
        $name = new stdClass();
        $name->category_id = Category::Category_id_name;
        $name->name = Category::Name_name;
        return $name;
    }


    /**
     *
     * @property string film_id
     * @property string category_id
     * */
    public static function getFilmCategoryNames(): stdClass{
        $name = new stdClass();
        $name->film_id = Film_category::Film_id_name;
        $name->category_id = Film_category::Category_id_name;
        return $name;
    }

    /**
     * @property string actor_id
     * @property string first_name
     * @property string last_name
     * */
    public static function getActorNames():stdClass{
        $name = new stdClass();
        $name->actor_id = Actor::actor_id_name;
        $name->first_name = Actor::First_name_name;
        $name->last_name = Actor::Last_name_name;
        return $name;
    }

    /**
     * @property string film_id
     * @property string actor_id
     * */

    public static function getFilmActorNames():stdClass{
        $name = new stdClass();
        $name->film_id = Film_actor::film_id_name;
        $name->actor_id = Film_actor::actor_id_name;
        return $name;
    }
}
