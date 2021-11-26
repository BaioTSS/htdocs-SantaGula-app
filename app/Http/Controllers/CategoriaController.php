<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;

class CategoriaController extends Controller
{
    public function show($id)
    {
      $categoria = Categorias::find($id);
      $productos = $categoria->productos()->paginate(10);
      return view('categorias.show')->with(compact('categoria', 'productos'));
    }
}
