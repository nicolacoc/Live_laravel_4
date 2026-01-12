<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int actor_id
 * @property string first_name
 * @property string last_name
 *
 * */

class Actor extends Model
{
    use HasFactory;

    const First_name_name = 'first_name';
    const Last_name_name = 'last_name';

    const last_update_name = 'last_update';

    const actor_id_name = 'actor_id';

    const laravel_through_key_name = 'laravel_through_key';

    protected $table = 'actor';
    protected $primaryKey = 'actor_id';
    public $timestamps = false;
    protected $fillable=[
      self::First_name_name,
        self::Last_name_name,
    ];

    protected $hidden=[
        self::laravel_through_key_name,
        self::last_update_name,
        self::actor_id_name,
    ];


    public function films(){
        return $this->hasManyThrough(Film::class, Film_actor::class, self::actor_id_name, Film::Film_id_name, self::actor_id_name, Film::Film_id_name);
    }


}
