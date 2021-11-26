<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorias;

class CategoriaController extends Controller
{
  public function index()
  {
      $categorias = Categorias::paginate(10);
      return view('admin.categorias.index')->with(compact('categorias')); //muestra el listado de platos
  }

  public function create()
  {
      return view('admin.categorias.create'); //formulario de registro de platos
  }

  public function store(Request $request)
  {
      //Validacion de campos de datos
      $mensaje = [
          'name.required' => 'El nombre es un campo obligatorio.',
          'name.min' => 'El nombre de la categoria debe tener al menos 3 caracteres.',
          'descripcion.max' => 'La descripción solo admite hasta 250 caracteres',

      ];
      $rules = [
          'name' => 'required|min:3',
          'descripcion' => 'max:250',
      ];
      $this->validate($request, $rules, $mensaje);
      //registra los nuevos platos en la BD
      //dd($request->all()); //Muestro por pantalla el array completo que voy a enviar
      $categorias = new Categorias();
      $categorias->nombre = $request->input('name');
      $categorias->descripcion = $request->input('descripcion');
      $categorias->save(); //acá hace un INSERT

      return redirect('/admin/categorias');
  }

  public function edit($id)
  {
      //return "Mostrar aquí el formulario de edicion para el plato con el id $id";
      $categoria = Categorias::find($id);
      return view('admin.categorias.edit')->with(compact('categoria')); //formulario de edicion de platos
  }

  public function update(Request $request, $id)
  {
      //Validacion de campos de datos
      $mensaje = [
        'name.required' => 'El nombre es un campo obligatorio.',
        'name.min' => 'El nombre de la categoria debe tener al menos 3 caracteres.',
        'descripcion.max' => 'La descripción solo admite hasta 250 caracteres',
      ];
      $rules = [
        'name' => 'required|min:3',
        'descripcion' => 'max:250',
      ];
      $this->validate($request, $rules, $mensaje);
      //actualizamos las ediciones
      $categorias = Categorias::find($id); //aca buscamos al producto
      $categorias->nombre = $request->input('name');
      $categorias->descripcion = $request->input('descripcion');
      $categorias->save(); //acá hace un UPDATE

      return redirect('/admin/categorias');
  }

  public function destroy($id)
  {
      ///Eliminación de producto
      $productos = Categorias::find($id); //aca buscamos al producto
      $productos->delete(); //DELETE

      return redirect('/admin/categorias');
  }
}
