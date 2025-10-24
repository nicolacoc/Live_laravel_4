<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property int language_id
 * @property string name;
 *
 *
 *
 *  */
class Film_language extends Model
{
    use HasFactory;

    const Language_id_name = 'language_id';
    const Name_name = 'name';
    const Last_update_name = 'last_update';

    protected $primaryKey = self::Language_id_name;
    protected $table = 'language';
    protected $fillable = [self::Name_name];

    protected $hidden = [self::Language_id_name, self::Last_update_name];

    public $timestamps = false;

    public function film()
    {
        return $this->hasMany(Film::class, Film::Language_id_name, self::Language_id_name);
    }
}
