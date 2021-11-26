<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Categorias;


class ProductoController extends Controller
{
    public function index()
    {
        $productos = Productos::paginate(10);
        return view('admin.productos.index')->with(compact('productos')); //muestra el listado de platos
    }

    public function create()
    {
        $categorias = Categorias::orderBy('id')->get();
        return view('admin.productos.create')->with(compact('categorias')); //formulario de registro de platos
    }

    public function store(Request $request)
    {
        //Validacion de campos de datos
        $mensaje = [
            'name.required' => 'El nombre es un campo obligatorio.',
            'name.min' => 'El nombre del plato debe tener al menos 3 caracteres.',
            'code.required' => 'El codigo es un campo obligatorio',
            'code.numeric' => 'El codigo del plato debe ser un valor numerico.',
            'code.min' => 'No se admiten valores negativos para el codigo del plato.',
            'descripcion.required' => 'La descripción es un campo obligatorio',
            'descripcion.max' => 'La descripción solo admite hasta 200 caracteres',
            'price.required' => 'El precio es un campo obligatorio.',
            'price.numeric' => 'El precio del plato debe ser un valor numerico.',
            'price.min' => 'No se admiten valores negativos para el precio del plato.',
        ];
        $rules = [
            'name' => 'required|min:3',
            'code' => 'required|numeric|min:0',
            'descripcion' => 'required|max:200',
            'price' => 'required|numeric|min:0',
        ];
        $this->validate($request, $rules, $mensaje);
        //registra los nuevos platos en la BD
        //dd($request->all()); //Muestro por pantalla el array completo que voy a enviar
        $productos = new Productos();
        $productos->nombre = $request->input('name');
        $productos->codigo = $request->input('code');
        $productos->categorias_id = $request->categoria_id;
        $productos->sector = $request->input('sector');
        $productos->descripcion = $request->input('descripcion');
        //$productos->l_descripcion = $request->input('l_descripcion');
        $productos->precio = $request->input('price');
        $productos->save(); //acá hace un INSERT

        return redirect('/admin/platos');
    }

    public function edit($id)
    {
        //return "Mostrar aquí el formulario de edicion para el plato con el id $id";
        $producto = Productos::find($id);
        $categorias = Categorias::orderBy('id')->get();
        return view('admin.productos.edit')->with(compact('producto', 'categorias')); //formulario de edicion de platos
    }

    public function update(Request $request, $id)
    {
        //Validacion de campos de datos
        $mensaje = [
            'name.required' => 'El nombre es un campo obligatorio.',
            'name.min' => 'El nombre del plato debe tener al menos 3 caracteres.',
            'code.required' => 'El codigo es un campo obligatorio',
            'code.numeric' => 'El codigo del plato debe ser un valor numerico.',
            'code.min' => 'No se admiten valores negativos para el codigo del plato.',
            'descripcion.required' => 'La descripción es un campo obligatorio',
            'descripcion.max' => 'La descripción solo admite hasta 200 caracteres',
            'price.required' => 'El precio es un campo obligatorio.',
            'price.numeric' => 'El precio del plato debe ser un valor numerico.',
            'price.min' => 'No se admiten valores negativos para el precio del plato.',
        ];
        $rules = [
            'name' => 'required|min:3',
            'code' => 'required|numeric|min:0',
            'descripcion' => 'required|max:200',
            'price' => 'required|numeric|min:0',
        ];
        $this->validate($request, $rules, $mensaje);
        //actualizamos las ediciones
        $productos = Productos::find($id); //aca buscamos al producto

        $productos->nombre = $request->input('name');
        $productos->codigo = $request->input('code');
        $productos->categorias_id = $request->categoria_id;
        $productos->sector = $request->input('sector');
        $productos->descripcion = $request->input('descripcion');
        //$producos->l_descripcion = $request->input('l_descripcion');
        $productos->precio = $request->input('price');
        $productos->save(); //acá hace un UPDATE

        return redirect('/admin/platos');
    }

    public function destroy($id)
    {
        ///Eliminación de producto
        $productos = Productos::find($id); //aca buscamos al producto
        $productos->delete(); //DELETE

        return redirect('/admin/platos');
    }
}
