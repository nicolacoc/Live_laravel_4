<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class users_controller extends Controller
{
    public function index():array{
        $select = db::select("select * from users where name like ?",['b%']);

        return $select;

    }
}
