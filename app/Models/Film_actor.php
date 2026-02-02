<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film_actor extends Model
{
    const last_update_name = 'last_update';
    const actor_id_name = 'actor_id';
    const film_id_name = 'film_id';

    use HasFactory;
    protected $table = 'film_actor';
    protected $fillable = ['actor_id', 'film_id'];


    public $timestamps = false;

}
