<?php

namespace App\Http\Controllers\Ausiliari_film;

use App\Models\Film;
use App\Models\Film_actor;
use App\Models\Film_category;
use App\Models\Film_text;
use stdClass;

class FilmAuxiliary
{
    /**
     * @param mixed $id
     * @return bool|mixed|null
     */
    public static function delete(mixed $id): mixed
    {
        $film_category_count = Film_category::query()->find($id)->count();

        $film_actor_count = Film_actor::query()->where(Film_actor::film_id_name, $id)->count();

        $film_text_count = Film_text::query()->where(Film_text::Film_id_name, $id)->count();


        if ($film_category_count > 0) {
            $film_category = Film_category::query()->find($id)->delete();
        } else {
            $film_category = true;
        }

        if ($film_actor_count > 0) {
            $film_actor = Film_actor::query()->where(Film_actor::film_id_name, $id)->delete();
        }else{
            $film_actor=true;
        }

        if ($film_text_count > 0) {
            $film_text = Film_text::query()->where(Film_text::Film_id_name, $id)->delete();
        }else{
            $film_text=true;
        }

        if ($film_category && $film_actor && $film_text) {
            $film = Film::query()->findorfail($id)->delete();
        } else {
            $film = false;
        }
        return $film;
    }



}
