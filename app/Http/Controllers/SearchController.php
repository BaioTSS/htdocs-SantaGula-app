<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->input('query');
        $productos = Productos::where('nombre', 'like', "%$query%")->paginate(5);

        if ($productos->count() == 1) {
          $id =$productos->first()->id;
          return redirect("platos/$id");
        }

        return view('search.show')->with(compact('productos', 'query'));
    }

    public function data()
    {
        $productos = Productos::pluck('nombre');
        return $productos;
    }
}
