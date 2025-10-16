<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    use HasFactory;
    protected $table = 'film_text';

    protected $fillable = ['film_id','title', 'description'];

    protected $hidden = ['film_id'];

    public $timestamps = false;


    /**
     * @see Film
     * */
    public function film(){
        return $this->hasOne(film::class, 'film_id', 'film_id');
    }

    /**
     * @see Category;
     * */
    public function category()
    {
        return $this->hasOneThrough(Category::class, Film_category::class, 'film_id', 'category_id', 'film_id', 'category_id');
    }



}
