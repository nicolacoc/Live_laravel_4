<?php
/**
 * @property string $title
 * @property string $description
 * @property integer $release_year
 * @property string $slug
 * @property string $image
 *
 *
 *
 * */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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

    public function actors()
    {
        return $this->hasOneThrough(Actor::class, Film_actor::class, 'film_id', 'actor_id', 'film_id', 'actor_id');
    }

    /**
     * @see Language::class;
     * */
    public function Language()
    {
        return $this->hasOne(Language::class, 'language_id', 'language_id');
    }

    /**
     * @see Language::class;
     * */
    public function original_language()
    {
        return $this->hasOne(Language::class, 'language_id', 'original_language_id');
    }

    /**
     * @see Category::class;
     * */
    public function category()
    {
        return $this->hasOneThrough(Category::class, Film_category::class, 'film_id', 'category_id', 'film_id', 'category_id');
    }

    /**
     * @see Film_text::class;
     * */
    public function description(){
        return $this->hasOne(Film_text::class, 'film_id', 'film_id');
    }


}
