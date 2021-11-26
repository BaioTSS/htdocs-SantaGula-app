<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\ProductImage;
use File;

class ImagenController extends Controller
{
  public function index($id)
  {
      $producto = Productos::find($id);
      $imagenes = $producto->imagenes()->orderBy('featured', 'desc')->get();
      return view('admin.productos.imagenes.index')->with(compact('producto', 'imagenes'));
  }
  public function store(Request $request, $id)
  {
      // guardamos la img en nuestro proyecto
      $file = $request->file('foto');
      $path = public_path() . '/imagenes/productos';
      $filName = uniqid() . $file->getClientOriginalName();
      $moved = $file->move($path, $filName);

      // SI se movio la imagen a la carpeta
      //creamos un registro en la tabla product_images
      if ($moved) {
        $productoImagen = new ProductImage();
        $productoImagen->imagen = $filName;
        //$productoImagen->featured = ;
        $productoImagen->productos_id = $id;
        $productoImagen->save(); //INSERT
      }
      return back();

  }
  public function destroy(Request $request, $id)
  {
      // eliminar el archivo
      $productoImagen = ProductImage::find($request->input('imagen_id'));
      //if(substr($productoImagen->imagen, 0, 4) === "http"){
      //  $deleted = true;
      //}else {
        $fullPath = public_path() . '/imagenes/productos/' . $productoImagen->imagen;
        $deleted = File::delete($fullPath);
      //}

      // eliminar el registro de la img en la bd
      if ($deleted) {
          $productoImagen->delete();
      }
      return back();

  }
  public function select($id, $imagen)
  {
      ProductImage::where('productos_id', $id)->update([
          'featured' => false
      ]);

      $productoImagen = ProductImage::find($imagen);
      $productoImagen->featured = true;
      $productoImagen->save();

      return back();
  }
}
