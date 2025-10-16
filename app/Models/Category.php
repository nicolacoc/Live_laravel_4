<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int category_id
 * @property string name
 * */

class Category extends Model
{
    use HasFactory;



    protected $table = 'category';

    protected $fillable = ['name'];

    protected $primaryKey = 'category_id';

    protected $hidden = ['category_id', 'last_update', 'laravel_through_key'];

    public $timestamps = false;

    public function films(){
        return $this->belongsToMany(Film::class, 'film_category', 'category_id', 'film_id');
    }
}
