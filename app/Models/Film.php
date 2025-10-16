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
 *
 *
 *
 * */


class Film extends Model
{
    use HasFactory;

    protected $table = 'film';
    protected $primaryKey = 'film_id';

    public $timestamps = false;


    protected $fillable = [
        'title',
        'description',
        'language_id',
        'original_language_id',
        'release_year',
        'slug',
        'image'
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
