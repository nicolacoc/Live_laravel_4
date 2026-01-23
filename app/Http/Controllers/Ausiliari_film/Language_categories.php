<?php

namespace App\Http\Controllers\Ausiliari_film;

use App\Models\Category;
use App\Models\Film_language;
use stdClass;

class Language_categories
{
    public static function get_Language_categories(stdClass $film): array
    {
        $languages_sql = Film_language::query()->get();

        $categories_sql = Category::query()->get();

        $languages = $languages_sql->map(function ($language) use ($film) {
            $language['actual'] = ($language->language_id == $film->language_id) ? 'selected' : '';
            return $language;
        });
        $original_languages = $languages_sql->map(function ($language) use ($film) {
            $language['actual'] = ($language->language_id == $film->original_language_id) ? 'selected' : '';
            return $language;
        });

        $categories = $categories_sql->map(function ($category) use ($film) {
            $category['actual'] = ($category->category_id == $film->category_id) ? 'selected' : '';
            return $category;
        });
        return array($languages, $original_languages, $categories);
    }
}
