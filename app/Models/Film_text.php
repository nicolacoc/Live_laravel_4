<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property string title
 * @property string description
 *
 *
 * */
class Film_text extends Model
{
    use HasFactory;
    protected $table = 'film_text';
    protected $primaryKey = 'film_id';
    protected $fillable = ['title', 'description'];

    protected $hidden = ['film_id', 'title'];

    public function film(){
        return $this->hasOne(film::class, 'film_id', 'film_id');
    }

    /**
     * @see Category::class;
     * */
    public function category()
    {
        return $this->hasOneThrough(Category::class, Film_category::class, 'film_id', 'category_id', 'film_id', 'category_id');
    }



}
