<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;

class ProductoController extends Controller
{
  public function show($id)
  {
      $plato = Productos::find($id);
      $imagenes =  $plato->imagenes;

      $imagenesIzq = collect();
      $imagenesDer = collect();
      foreach ($imagenes as $key => $imagen) {
        if ($key%2==0) {
          $imagenesDer->push($imagen);
        }else {
          $imagenesIzq->push($imagen);
        }
      }
      return view('productos.show')->with(compact('plato','imagenesIzq','imagenesDer'));
  }
}
