<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class category_controller extends Controller
{
    public function index_admin(Request $request)
    {

        $category_list = Cache::remember('category_list', 60, function () use ($request) {


            $category = Category::query()->get();


            return $category->map(function ($category) {
                $item = new \stdClass();
                $item->categoria = $category->name;
                return $item;
            });
        });

        return view('Films_category_admin', [
            'category_list' => $category_list
        ]);
    }
}
