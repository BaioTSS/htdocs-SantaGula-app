<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //use HasFactory;

    //protected $fillable = [
    //'id',
    //'imagen',
    //'featured',
    //'producto_id',
    //];

    public function producto()
    {
        return $this->belongsTo(Productos::class);//De esta manera a que producto
                                                  //le corresponde "x" imagen
    }
    // accesor
    public function getUrlAttribute()
    {
        return '/imagenes/productos/'.$this->imagen;
    }

}
