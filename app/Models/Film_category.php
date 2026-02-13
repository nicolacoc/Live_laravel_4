<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @property int film_id
 * @property int category_id
 */
class Film_category extends Model
{
    use HasFactory;

    use Searchable;

    const Category_id_name = 'category_id';

    const Film_id_name = 'film_id';

    protected $table = 'film_category';

    public $timestamps = false;

    protected $fillable = [self::Film_id_name, self::Category_id_name];

    protected $primaryKey = self::Film_id_name;


/**
 * @see Category
 *
 */
    public function category(){
        return $this->belongsTo(Category::class, Category::Category_id_name, self::Category_id_name);
    }

}
