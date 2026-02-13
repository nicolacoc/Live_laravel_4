<?php

namespace App\Http\Controllers\Ausiliari_film;

use App\Models\Film;
use App\Models\Film_category;
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

        if ($film_category_count > 0) {
            $film_category = Film_category::query()->find($id)->delete();
        } else {
            $film_category = true;
        }

        if ($film_category) {
            $film = Film::query()->findorfail($id)->delete();
        } else {
            $film = false;
        }
        return $film;
    }

}
