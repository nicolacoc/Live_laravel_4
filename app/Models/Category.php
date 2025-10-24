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
    const Name_name = 'name';
    const Category_id_name = 'category_id';

    const laravel_through_key_name = 'laravel_through_key';
    const last_update_name = 'last_update';





    protected $table = 'category';

    protected $fillable = [self::Name_name];

    protected $primaryKey = self::Category_id_name;

    protected $hidden = [
        self::Category_id_name,
        self::last_update_name,
        self::laravel_through_key_name
    ];

    public $timestamps = false;

    public function films(){
        return $this->hasManyThrough(Film::class, Film_category::class, self::Category_id_name, Film::Film_id_name, self::Category_id_name, Film::Film_id_name);
    }
}
