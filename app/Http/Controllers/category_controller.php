<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Ausiliari_film\FilmName;
use App\Http\Requests\Category_ins_upd_Request;
use App\Models\Category;
use App\Models\Film_category;
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
                $item->id = $category->category_id;
                return $item;
            });
        });

        return view('Films_category_admin', [
            'category_list' => $category_list
        ]);
    }

    public function show_create(Request $request)
    {
        $name = FilmName::getCategoryNames();
        $category = new \stdClass();
        $category->category_id = (($request->old($name->category_id))) ? $request->old($name->category_id) : 0;
        $category->name = (($request->old($name->name))) ? $request->old($name->name) : '';
        $url = route('films_category.insert');
        return view('category_edit', [
            'category' => $category,
            'name' => $name,
            'url' => $url
        ]);
    }

    public function show_edit(Request $request)
    {
        $category_sql = Category::query()->findorfail($request->id);
        $name = FilmName::getCategoryNames();
        $category = new \stdClass();
        $category->category_id = $category_sql->category_id;
        $category->name = (($request->old($name->name)) ? $request->old($name->name) : $category_sql->name);
        $url = route('films_category.update', ['id' => $category->category_id]);
        return view('category_edit', [
            'category' => $category,
            'name' => $name,
            'url' => $url
        ]);
    }

    public function insert(Category_ins_upd_Request $request)
    {
        Cache::flush();
        $category = new Category();
        $category->name = $request->name;
        $category_ok = $category->save();

        if ($category_ok) {
            return redirect()
                ->route('films_category.index')
                ->with(['message'=>'Categoria Inserita con successo']);
        }else{
            return redirect()
                ->back()
                ->withErrors(['error'=>'Errore durante l\'inserimento'])
                ->withInput($request->all());
        }
    }

    public function delete(Request $request)
    {
        $film_Category_count = Film_category::query()->where('category_id',$request->id)->count();
        if ($film_Category_count > 0) {
          $film_category = Film_category::query()->where('category_id',$request->id)->delete();
        }else{
            $film_category=true;
        }

        if ($film_category) {
            $category = Category::query()->findorfail($request->id)->delete();
        }else{
            $category=false;
        }
        Cache::flush();

        if( $category) {
            return redirect()
                ->route('films_category.index')
                ->with(['message'=>'Categoria eliminata con successo']);
        }else{
            return redirect()
                ->route('films_category.index')
                ->withErrors(['error'=>'Errore durante l\'eliminazione']);
        }
    }

    public function update(Category_ins_upd_Request $request)
    {
        $category = Category::query()->findorfail($request->id)->update(['name'=>$request->name]);
        Cache::flush();
        if ($category) {
            return redirect()
                ->route('films_category.index')
                ->with(['message'=>'Categoria aggiornata con successo']);
        }else{
            return redirect()
                ->back()
                ->withErrors(['error'=>'Errore durante l\'aggiornamento'])
                ->withInput($request->all());
        }
    }
}
