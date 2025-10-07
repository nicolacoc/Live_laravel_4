<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class file_controller extends Controller
{
    public function index(Request $request):string{
        $id= $request->id;
        $file = $request->file('file');


      $name=  Storage::putFile('public', $file);

        $film= Film::query()->find($id);

        $film->image = $name;

        $film->save();


        return $film->image;
    }
}
