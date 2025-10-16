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

    protected $primaryKey = 'language_id';
    protected $table = 'language';
    protected $fillable=['name'];

    protected $hidden = ['last_update', 'language_id'];

    public $timestamps = false;

    public function film(){
        return $this->hasMany(Film::class, 'language_id', 'language_id');
    }
}
