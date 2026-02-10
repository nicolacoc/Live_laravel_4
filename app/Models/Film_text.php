<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 *
 * @property int film_id
 * @property string description
 * @property string title
 *
 *
 * */
class Film_text extends Model
{

    const Film_id_name = 'film_id';
    const Title_name = 'title';
    const Description_name = 'description';

    use HasFactory;

    use Searchable;

    protected $table = 'film_text';

    protected $fillable = [self::Film_id_name,self::Title_name, self::Description_name];

    protected $hidden = [self::Film_id_name];

    public $timestamps = false;


    /**
     * @see Film
     * */
    public function film(){
        return $this->hasOne(film::class, Film::Film_id_name, self::Film_id_name);
    }

    /**
     * @see Category;
     * */
    public function category()
    {
        return $this->hasOneThrough(Category::class, Film_category::class, self::Film_id_name, Category::Category_id_name, self::Film_id_name, Category::Category_id_name);
    }



}
