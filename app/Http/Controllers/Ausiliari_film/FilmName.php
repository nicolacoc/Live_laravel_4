<?php

namespace App\Http\Controllers\Ausiliari_film;

use App\Models\Category;
use App\Models\Film;
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
}
