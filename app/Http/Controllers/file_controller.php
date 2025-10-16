<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class file_controller extends Controller
{
    public function index(Request $request): string
    {

        $validated = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'file.required' => 'The file field is required.',
            'file.image' => 'The file must be an image.',
            'file.mimes' => 'The file must be a file of type: jpeg, png, jpg, gif.',
            'file.max' => 'The file may not be greater than 2048 kilobytes.'
        ])->validate();

        $id = $request->id;
        $name = Storage::putFile('public', $validated['file']);
        $film = Film::query()->find($id);
        $film->image = $name;
        $film->save();


        return $film->image;
    }
}
