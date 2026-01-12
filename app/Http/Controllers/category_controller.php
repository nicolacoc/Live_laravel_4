<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use stdClass;

class category_controller extends Controller
{
    public function index(Request $request)
    {

        return Cache::remember('category_' . $request->id, 60, function () use ($request) {


            $category = Category::query()->with('films')->find($request->id);

            $item = new stdClass();
            $item->categoria = $category->name;
            $item->films = $category->films->map(fn($item) => $item->title)->toArray();
            return $item;
        });
    }
}
