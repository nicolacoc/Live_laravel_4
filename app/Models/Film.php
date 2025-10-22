<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property string title
 * @property string description
 * @property integer release_year
 * @property string slug
 * @property string image
 * @property integer language_id
 * @property integer original_language_id
 *
 *
 *
 * */


class Film extends Model
{
    use HasFactory;

    const Title_name = 'title';
    const Description_name = 'description';
    const Release_year_name = 'release_year';
    const Slug_name = 'slug';
    const Image_name = 'image';
    const Language_id_name = 'language_id';
    const Original_language_id_name = 'original_language_id';
    const Rating_name = 'rating';
    const Special_features_name = 'special_features';
    const Rental_duration_name = 'rental_duration';
    const Rental_rate_name = 'rental_rate';
    const Length_name = 'length';
    const Replacement_cost_name = 'replacement_cost';

    protected $table = 'film';
    protected $primaryKey = 'film_id';

    public $timestamps = false;

    protected $hidden = [
        'laravel_through_key',
        'last_update',
        'film_id',
        'language_id',
        'original_language_id',
        'actor_id'
    ];


    protected $fillable = [
        'title',
        'description',
        'language_id',
        'original_language_id',
        'release_year',
        'slug',
        'image',
        'rating',
        'special_features',
        'rental_duration',
        'rental_rate',
        'length',
        'replacement_cost'
    ];

    /**
     * @see Actor;
     * */
    public function actors()
    {
        return $this->hasManyThrough(Actor::class, Film_actor::class, 'film_id', 'actor_id', 'film_id', 'actor_id');
    }

    /**
     * @see Film_language;
     * */
    public function Language()
    {
        return $this->hasOne(Film_language::class, 'language_id', 'language_id');
    }

    /**
     * @see Film_language;
     * */
    public function original_language()
    {
        return $this->hasOne(Film_language::class, 'language_id', 'original_language_id');
    }

    /**
     * @see Category;
     * */
    public function category()
    {
        return $this->hasOneThrough(Category::class, Film_category::class, 'film_id', 'category_id', 'film_id', 'category_id');
    }

    /**
     * @see Film_text
     * */
    public function Film_Text(){
        return $this->hasOne(Film_text::class, 'film_id', 'film_id');
    }


}
