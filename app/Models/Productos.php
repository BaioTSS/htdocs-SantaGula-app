<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categorias_id');//De esta manera podemos consultar a que
                                                   //categoria pertenece un producto
    }

    public function imagenes()
    {
        return $this->hasMany(ProductImage::class);//De esta manera podemos consultar que
                                                  //imagenes le pertenecen un producto
    }

    public function getFeaturedImagenUrlAttribute()
    {
        $featuredImagen = $this->imagenes()->where('featured', true)->first();
        if(!$featuredImagen) {//no tiene una imagen destacada
          $featuredImagen = $this->imagenes()->first();
        }
        if ($featuredImagen) {
          return $featuredImagen->url;
        }

        //img por defecto
        return '/imagenes/productos/default-image_500.png';
    }

    public function getCategoriaNombreAttribute() // tambien se podia resolver desde la vista así
    {                                             // $producto->categoria ? $producto->categoria_nombre  : 'Sin categoria'
        if($this->categoria) {
          return $this->categoria->nombre;
        }else {
          return 'Sin categoria'; //'Sin categoria';
        }
    }
}
