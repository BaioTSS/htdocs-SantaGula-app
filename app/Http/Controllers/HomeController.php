<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;

class HomeController extends Controller
{
    public function welcome()
    {
        $categorias = Categorias::has('productos')->get();
        return view('welcome')->with(compact('categorias'));
    }
}
