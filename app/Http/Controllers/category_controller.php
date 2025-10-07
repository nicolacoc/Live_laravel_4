<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class category_controller extends Controller
{
    public function index(Request $request)
    {

        $category = Category::query()->with('films')->find($request->id);




        $item = new \stdClass();
        $item->categoria = $category->name;
        $item->films = $category->films->map(fn($item) => $item->title);
        return $item;

    }
}
