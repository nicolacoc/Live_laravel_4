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

    protected $table = 'actor';
    protected $primaryKey = 'actor_id';
    public $timestamps = false;
    protected $fillable=[
      'first_name',
        'last_name'
    ];

    protected $hidden=[
        'laravel_through_key',
        'last_update'
    ];


    public function films(){
        return $this->belongsToMany(Film::class, 'film_actor', 'actor_id', 'film_id');
    }
}
