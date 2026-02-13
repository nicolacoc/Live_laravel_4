<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @property int film_id
 * @property string title
 * @property string description
 * @property integer release_year
 * @property string slug
 * @property string image
 * @property integer language_id
 * @property integer original_language_id
 * @property float replacement_cost
 * @property float rental_rate
 * @property float length
 * @property float rating
 * @property string special_features
 * @property integer rental_duration
 * @see Film_text;
 * @see Film_language;
 * @see Actor;
 * @see Category;
 * @see Film_category;
 * @see Film_actor;
 *
 *
 * */
class Film extends Model
{
    use HasFactory;
    use Searchable;


    const Film_id_name = 'film_id';
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
    const Laravel_through_key_name = 'laravel_through_key';
    const Last_update_name = 'last_update';

        protected $table = 'film';
    protected $primaryKey = self::Film_id_name;

    public $timestamps = false;

    protected $hidden = [
        self::Laravel_through_key_name,
        self::Last_update_name,
        self::Language_id_name,
        self::Original_language_id_name
    ];


    protected $fillable = [
        self::Title_name,
        self::Description_name,
        self::Language_id_name,
        self::Original_language_id_name,
        self::Release_year_name,
        self::Slug_name,
        self::Image_name,
        self::Rating_name,
        self::Special_features_name,
        self::Rental_duration_name,
        self::Rental_rate_name,
        self::Length_name,
        self::Replacement_cost_name
    ];

    /**
     * @see Actor;
     * */
    public function actors()
    {
        return $this->hasManyThrough(Actor::class, Film_actor::class, self::Film_id_name, Actor::actor_id_name, self::Film_id_name, Actor::actor_id_name);
    }

    /**
     * @see Film_language;
     * */
    public function Language()
    {
        return $this->hasOne(Film_language::class, Film_language::Language_id_name, self::Language_id_name);
    }

    /**
     * @see Film_language;
     * */
    public function original_language()
    {
        return $this->hasOne(Film_language::class, Film_language::Language_id_name, self::Original_language_id_name);
    }

    /**
     * @see Category;
     * */
    public function category()
    {
        return $this->hasOneThrough(Category::class, Film_category::class, self::Film_id_name, Category::Category_id_name, self::Film_id_name, Category::Category_id_name);
    }

    /**
     * @see Film_text
     * */
    public function Film_Text()
    {
        return $this->hasOne(Film_text::class, Film_text::Film_id_name, self::Film_id_name);
    }


}
